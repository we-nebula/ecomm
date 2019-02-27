<?php


namespace nebula\we\App;


use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

class Admin extends \nebula\we\App {

	public $title = "WE :: Commission Engine (2)";
	
	function init(){
		parent::init();

		$adapter = new Local(getcwd().'/localfiles');
		$this->filesystem = new Filesystem($adapter);

		$this->dbConnect($this->getConfig('dns'), $this->getConfig('db_user'), $this->getConfig('db_password'));

		$this->auth = $this->add(new \atk4\login\Auth());
	    $this->auth->setModel(new \nebula\we\Model\Employee($this->db),'username','password');
	    $this->auth->model = $this->auth->user;

		$this->createMenus();
		//$this->sidecreateMenus();
		$this->router('page',['nebula\we\page']);

	}

	function createMenus(){
		$menu = $this->app->layout->menu->addMenu('System');
		$menu->addItem('Employee',$this->app->pageUrl('employees'));
		$menu->addItem('Settings',$this->app->pageUrl('settings'));

		$sm = $menu->addMenu('Attribute');
		$sm->addItem('Attribute',$this->app->pageUrl('attributes'));
		$sm->addItem('AttributeDescription',$this->app->pageUrl('attributesdescription'));

		$sm = $menu->addMenu('Attribute Value');
		$sm->addItem('AttributeValue',$this->app->pageUrl('attributesvalues'));
		$sm->addItem('AttributeValueDescription',$this->app->pageUrl('attributesvaluesdescription'));

		$sm = $menu->addMenu('Media');
		$sm->addItem('Media',$this->app->pageUrl('medias'));
		$sm->addItem('Media Description',$this->app->pageUrl('mediadescriptions'));

		$menu->addItem('StockMovementReason',$this->app->pageUrl('stockmovementreasons'));

		$menu = $this->app->layout->menu->addMenu('Vendor');	
		$menu->addItem('Vendor',$this->app->pageUrl('vendors'));
		$menu->addItem('VendorDescription',$this->app->pageUrl('vendorsdescription'));
		$menu->addItem('Warehouse',$this->app->pageUrl('warehouses'));
		
		$menu = $this->app->layout->menu->addMenu('Catalouge');	

		$sm = $menu->addMenu('Category');
		$sm->addItem('Category',$this->app->pageUrl('categories'));
		$sm->addItem('CategoryDetail',$this->app->pageUrl('categoriesdetail'));
		$sm->addItem('CategoryAttributeMaP',$this->app->pageUrl('categoryattributemaps'));

		$sm = $menu->addMenu('Product');
		$sm->addItem('Product',$this->app->pageUrl('products'));
		$sm->addItem('ProductAttachmentMap',$this->app->pageUrl('productattachmentmaps'));
		$sm->addItem('ProductCategory',$this->app->pageUrl('productcategories'));
		$sm->addItem('ProductAttachmentMap',$this->app->pageUrl('productattachmentmaps'));

		$sm = $sm->addMenu('Product Variation');
		$sm->addItem('ProductVariation',$this->app->pageUrl('productsvariation'));
		$sm->addItem('ProductAttributeMap',$this->app->pageUrl('productattributemaps'));
		$sm->addItem('ProductVariationAttributeValueMap',$this->app->pageUrl('productvariationattributevaluemaps'));
		$sm->addItem('ProductVariationAttachmentValueMap',$this->app->pageUrl('productvariationattachmentmaps'));

		$menu = $this->app->layout->menu->addMenu('Inventory');	
		$menu->addItem('Stock',$this->app->pageUrl('stocks'));

		// $menu = $this->app->layout->menu->addMenu('Commission System');
		// $menu = $this->app->layout->menu->addMenu('Reporting');
	}
	function sidecreateMenus()
    {	
        $this->app->layout->menuLeft->addItem(['Language'], ['index','page'=>'nebula\we\page\languages']);
        $this->app->layout->menuLeft->addItem(['Category'], ['index','page'=>'nebula\we\page\categories']);
        $this->app->layout->menuLeft->addItem(['CategoryDetail'], ['index','page'=>'nebula\we\page\categoriesdetail']);
        $this->app->layout->menuLeft->addItem(['Product'], ['index','page'=>'nebula\we\page\products']);
        $this->app->layout->menuLeft->addItem(['ProductDetail'], ['index','page'=>'nebula\we\page\productdetails']);
        $this->app->layout->menuLeft->addItem(['ProductCategory'], ['index','page'=>'nebula\we\page\productcategories']);
        $this->app->layout->menuLeft->addItem(['Attribute'], ['index','page'=>'nebula\we\page\attributes']);
        $this->app->layout->menuLeft->addItem(['AttributeDescription'], ['index','page'=>'nebula\we\page\attributesdescription']);
        $this->app->layout->menuLeft->addItem(['AttributeValue'], ['index','page'=>'nebula\we\page\attributesvalues']);
        $this->app->layout->menuLeft->addItem(['AttributeValueDescription'], ['index','page'=>'nebula\we\page\attributesvaluesdescription']);
        $this->app->layout->menuLeft->addItem(['CategoryAttributeMaP'], ['index','page'=>'nebula\we\page\categoryattributemaps']);
        $this->app->layout->menuLeft->addItem(['ProductAttributeMap'], ['index','page'=>'nebula\we\page\productattributemaps']);
    }

	function addURLArgs($arg,$value){
		$this->sticky_get_arguments[$arg] = $value;
	}

}