<?php

namespace nebula\we\Controller;

class Acl extends \nebula\we\Controller {
	
	public $model; // To put condition on model
	public $role; // Based on which post auth model user belongs to 
	public $view; // add acl button for super user and create actions based on ACL

	public $acl_type=null;
	public $available_options=['SelfOnly','All','None'];
	public $auth_model_role_field='role_id'; // Can be post_id or anything if Acl is applied in Department->Post->Employee System

	public $action_allowed=null; // Final Array determines action allowed
	public $permissive_acl = false;


	function init(){
		parent::init();

		$this->model = $this->getModel();
		$this->view = $this->getView();
		
		// Actual Acl between role and acl_type
		$this->role = $this->app->auth->model[$this->auth_model_role_field];
		$this->acl_type = $this->model->acl_type?:$this->model->getModelCaption();
		$this->acl_model = new \nebula\we\Model\Acl($this->app->db);
		
		$this->acl_model->addCondition('acl_type',$this->acl_type);
		$this->acl_model->addCondition('role_id',$this->role);
		$this->acl_model->tryLoadAny();


		if(isset($this->model->assigned_field)) $this->available_options = array_merge($this->available_options,['Assigned To Self']);

		$this->model_vp1 = $modal_vp1 = $this->app->add(['Modal', 'title' => 'Role Selection']);
		$modal_vp1->set(\Closure::fromCallable([$this,'manageAclPage']));

		$this->modal_vp2 = $this->app->add(['Modal', 'title' => 'ACL For Selected Role']);
		$this->modal_vp2->set(\Closure::fromCallable([$this,'manageAclForm']));

		if($this->app->auth->model->isSuperUser()){
			$acl_btn = $this->view->menu->addItem(['ACL', 'icon' => 'ban']);
			$acl_btn->on('click', $modal_vp1->show());
		}

		$this->canDo();

		// Apply Condition on Model
		$this->applyConditionOnModel();

		// Apply Actions on View
		$this->addActionsInView();
	}

	protected function applyConditionOnModel(){

		$view_array = $this->canView();
		$model = $this->model;

		$a=[];
		foreach ($view_array as $status => $acl) { // acl can be true(for all, false for none and [] for employee created_by_ids)

			if($status=='All' || $status=='*'){
				if($acl === true) break;
				if($acl === false) $acl = -1; // Shuold never be reached
				$model->addCondition($this->getConditionalField($status,'view'),$acl);
				break;
			}else{
				if($acl==="All") continue;
				if($acl === false){
					// $where_condition[] = "(false)";
					continue;
				}
				if($acl === true){
					// No employee condition .. just check status
					$where_condition[] = "([status] = \"$status\")";
				}else{
					$where_condition[] = "( ([".strtolower($status)."] in (". implode(",", $acl) .")) AND ([status] = \"$status\") )";
				}
			}
		}
		if(!empty($where_condition)){
			$q= $this->model->dsql();
			
			$filler_values=['status'=>$this->model->getElement('status')];
			foreach ($this->action_allowed_raw as $status => $actions) {
				$filler_values[strtolower($status)]=$this->model->getElement($this->getConditionalField($status,'view'));
			}

			$this->model->addCondition(
				$q->expr("(".implode(" OR ", $where_condition).")", 
						$filler_values
					)
				)
			;
		}
	}

	protected function addActionsInView(){
		if(!($this->view instanceof \atk4\ui\Table) && !($this->view instanceof \atk4\ui\Grid)) return;

		$this->view->addDecorator('status',new ActionDecorator);
	}

	protected function manageAclPage($p){
		$form = $p->add('Form',['buttonSave'=>['Button','update','primary']]);
		$g = $form->addGroup(['width' => 'two']);

		$g->addField('role', [
		    'Lookup',
		    'model'       => new \nebula\we\Model\Role($this->app->db),
		    'hint'        => 'Lookup field is just like AutoComplete, supports all the same options.',
		    'placeholder' => 'Search for roles',
		    'search'      => ['name'],
		]);
		$g->addField('entity',['disabled'=>true])->set($this->acl_type);

		$form->onSubmit(function($form){
			return [$this->modal_vp2->show(['role'=>$form->model['role']])];
		});
	}

	protected function manageAclForm($p){
		
		// Load Existing acl_model for given role/and type
		$acl_m = new \nebula\we\Model\Acl($this->app->db);
		$acl_m->addCondition('acl_type',$this->acl_type);
		$acl_m->addCondition('role_id',$this->app->stickyGet('role'));
		$acl_m->tryLoadAny();
		$acl_array= json_decode($acl_m['acl'],true);
		
		$form = $p->add('Form');
		$form->addField('allow_add',['CheckBox'])->set($acl_m['can_add']?true:false);

		foreach ($this->model->actions as $status => $actions) {
			$grp = $form->addGroup($status);
			foreach ($actions as $act) {
				$grp->add(['View'])->set($act);
				$grp->addField($status.'_'.$act,['DropDown'],['enum'=>$this->available_options])
					->set($acl_array[$status][$act]);
			}
		}

		$form->onSubmit(function($form)use($acl_m){
			$acl_array=[];
			foreach ($this->model->actions as $status => $actions) {
				$acl_array[$status]=[];
				foreach ($actions as $act) {
					$acl_array[$status][$act] = $form->model[$status.'_'.$act];
				}
			}

			$acl_m['can_add']=$form->model['allow_add'];
			$acl_m['acl']=json_encode($acl_array);
			$acl_m->save();
			
			return $form->success("ACL is all set, logout and login from this role to see effects");
		});
	}

	protected function canDo(){
		if($this->action_allowed===null){
			$this->action_allowed = json_decode($this->acl_model['acl'],true);
			$this->action_allowed_raw = json_decode($this->acl_model['acl'],true);
		}

		foreach ($this->model->actions as $status => $actions) {
			if($status=='*') $status='all';
			foreach ($actions as $action) {
				$acl_value = isset($this->action_allowed[$status][$action])?$this->action_allowed[$status][$action]:$this->permissive_acl;
				$this->action_allowed[$status][$action] = ($this->app->auth->model->isSuperUser() && $this->app->getConfig('all_rights_to_superuser',true))?true:$this->textToCode($acl_value);
			}
		}
	}

	protected function canView(){
		$view_array=[];

		foreach ($this->action_allowed as $status => $actions) {
			$view_array[$status] = isset($actions['view'])?$actions['view']:false;
		}

		return $view_array;
	}

	protected function getConditionalField($status,$action){
		if($this->action_allowed_raw[$status][$action] != 'Assigned To') return 'created_by_id';
		return isset($this->model->assigned_field)? $this->model->assigned_field: 'assigned_to_id';

	}

	function textToCode($text){
		$text = strtolower($text);

		if($text ==='' || $text === null) return $this->permissive_acl;
		if($text === 'none') return false;
		if($text === 'all' || $text === true ) return true;
		if($text === 'selfonly' || $text === 'self only') return [$this->app->auth->model->id];
		if(strpos($text, "assign") !== false) return [$this->app->auth->model->id];
		return $text;
	}

	function getModel(){
		return $this->owner instanceof \nebula\we\Model ? $this->owner: $this->owner->model;
	}

	function getView(){
		return $this->owner instanceof \nebula\we\Model ? $this->owner->owner: $this->owner;
	}

}


/**
 * Action Decorator class
 * Creates DropDown Menu in status column and on click calls action with PK of row
 */

class ActionDecorator extends \atk4\ui\TableColumn\Generic {
	public function getDataCellTemplate(\atk4\data\Field $f = null)
    {
    	$output = new \atk4\ui\DropDown(['id'=>'a'.uniqid()]);
    	$output->setSource(['AS','CDF']);
        return $output->render();
    }
}