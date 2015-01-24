<?php
namespace tests\units;

require_once './atoum.phar';
require_once '/../../hyla_tpl.class.php';

use \mageekguy\atoum;

$lang = 'en';

class hyla_tpl extends atoum\test
{
    public function testGetVersion ()
    {
        $tpl = new \Hyla_Tpl();
        $this->string($tpl->getVersion())->isEqualTo('0.7.3');
    }
	
    public function testGetFunctionList()
    {
		$tpl = new \Hyla_Tpl();
		$this->array( $tpl->getFunctionList())
			->array( $tpl->getFunctionList( false))
			->array( $tpl->getFunctionList( true))
			->array( $tpl->getFunctionList())->contains('ucfirst') 
			->array( $tpl->getFunctionList())->contains('ucwords') 
			->array( $tpl->getFunctionList())->contains('lower') 
			->array( $tpl->getFunctionList())->contains('upper') 
			->array( $tpl->getFunctionList())->contains('trim') 
			->array( $tpl->getFunctionList())->contains('rtrim') 
			->array( $tpl->getFunctionList())->contains('ltrim') 
			->array( $tpl->getFunctionList())->contains('escape') 
		;
    }
	
    public function testRegisterVarFunction()
    {
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', function () {return 1;}))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->contains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', create_function('$a', 'return $a;')))->isTrue()
			->array( $tpl->getFunctionList( true))->contains('f1');
			
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', create_function('$a', 'return $a;')))->isTrue()
			->array( $tpl->getFunctionList( true))->contains('f1')
			->boolean($tpl->registerVarFunction('f1', create_function('$b', 'return ($b+1);')))->isTrue()
			->array( $tpl->getFunctionList( true))->contains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', ''))->isFalse()
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->array( $tpl->getFunctionList( ))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', 123))->isFalse()
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->array( $tpl->getFunctionList( ))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', 1.23))->isFalse()
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->array( $tpl->getFunctionList( ))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', false))->isFalse()
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->array( $tpl->getFunctionList( ))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', new \stdClass()))->isFalse()
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->array( $tpl->getFunctionList( ))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', array()))->isFalse()
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->array( $tpl->getFunctionList( ))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerVarFunction('f1', null))->isFalse()
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->array( $tpl->getFunctionList( ))->notContains('f1');
	}
	
    public function testRegisterFunction()
    {
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', function () {return 1;}))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', function () {return 1;}, true))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->contains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', create_function('$a', 'return $a;'), true))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->contains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', create_function('$a', 'return $a;'), true))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->contains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->boolean($tpl->registerFunction('f1', create_function('$b', 'return ($b+1);'), true))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->contains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', '', true))->isFalse()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', 123, true))->isFalse()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', 1.23, true))->isFalse()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', array(), true))->isFalse()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', new \stdClass(), true))->isFalse()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
			
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', null, true))->isFalse()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->notContains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
		
		$tpl = new \Hyla_Tpl();
		$this->boolean($tpl->registerFunction('f1', create_function('$a', 'return $a;'), true))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->contains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1')
			->boolean($tpl->registerFunction('f1', create_function('$b', 'return ($b+1);'), false))->isTrue()
			->array( $tpl->getFunctionList())->notContains('f1')
			->array( $tpl->getFunctionList( true))->contains('f1')
			->array( $tpl->getFunctionList( false))->notContains('f1');
	}
	
    public function testImportFile()
    {
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '0.tpl'))->isEqualTo( '0.tpl');
		
		$tpl = new \Hyla_Tpl('.');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '0.tpl'))->isEqualTo( '0.tpl');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->variable( $tpl->importFile( '0.tpl'))->isNull();
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '0.tpl', null, null))->isEqualTo( '0.tpl');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->variable( $tpl->importFile( '1.tpl'))->isNull();
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '1.tpl'))->isEqualTo( '1.tpl');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->variable( $tpl->importFile( '1.tpl'))->isNull();
		
		$tpl = new \Hyla_Tpl('.');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->variable( $tpl->importFile( '1.tpl'))->isNull();
		
		$tpl = new \Hyla_Tpl('BadDir');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->variable( $tpl->importFile( '1.tpl'))->isNull();
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '1.tpl', null, 'template'))->isEqualTo( '1.tpl');
		
		$tpl = new \Hyla_Tpl('.');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '1.tpl', null, 'template'))->isEqualTo( '1.tpl');
		
		$tpl = new \Hyla_Tpl('BadDir');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '1.tpl', null, 'template'))->isEqualTo( '1.tpl');
		
		$tpl = new \Hyla_Tpl( null);
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '1.tpl', null, 'template'))->isEqualTo( '1.tpl');
		
		$tpl = new \Hyla_Tpl( 'template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '1.tpl', null, 'template'))->isEqualTo( '1.tpl');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '1.tpl', null, 'template'))->isEqualTo( '1.tpl')
			->string( $tpl->importFile( '2.tpl', null, 'template'))->isEqualTo( '2.tpl');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '0.tpl'))->isEqualTo( '0.tpl')
			->string( $tpl->importFile( '2.tpl', null, 'template'))->isEqualTo( '2.tpl');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( 'file0', '0.tpl'))->isEqualTo( 'file0');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( 'file1', '1.tpl', 'template'))->isEqualTo( 'file1');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( 'file1', '1.tpl', 'template'))->isEqualTo( 'file1')
			->string( $tpl->importFile( 'file2', '2.tpl', 'template'))->isEqualTo( 'file2');
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( 'file0', '0.tpl'))->isEqualTo( 'file0')
			->string( $tpl->importFile( 'file1', '1.tpl', 'template'))->isEqualTo( 'file1');
	}
	
    public function testRemoveUnknowVar()
	{
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile( '3-0.tpl');
		$this->string( $tpl->render())->isEqualTo('');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->removeUnknowVar( true);
		$tpl->importFile( '3-0.tpl');
		$this->string( $tpl->render())->isEqualTo('');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->removeUnknowVar( false);
		$tpl->importFile( '3-0.tpl');
		$this->string( $tpl->render())->isEqualTo('{$contenu}');
	}
	
    public function testSetCurrentFile()
    {
		/*
		$tpl = new \Hyla_Tpl();
		//	$tpl->displayError( false))->isFalse()
		//	$tpl->logError( false))->isFalse()
		$this->boolean( $tpl->setCurrentFile('0.tpl'))->isFalse();
		*/
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '0.tpl'))->isEqualTo( '0.tpl')
			->boolean( $tpl->setCurrentFile('0.tpl'))->isTrue();
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile( '0.tpl'))
			->boolean( $tpl->setCurrentFile('1.tpl'))->isFalse();
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile('file0', '0.tpl'))
			->boolean( $tpl->setCurrentFile('file0'))->isTrue();
		
		$tpl = new \Hyla_Tpl();
		$tpl->displayError( false);
		$tpl->logError( false);
		$this->string( $tpl->importFile('file0', '0.tpl'))
			->string( $tpl->importFile('file1', '1.tpl','template'))
			->string( $tpl->importFile('file2', '2.tpl','template'))
			->boolean( $tpl->setCurrentFile('file0'))->isTrue()
			->boolean( $tpl->setCurrentFile('file1'))->isTrue()
			->boolean( $tpl->setCurrentFile('file2'))->isTrue();
	}
	
    public function testSetL10nCallback()
    {
		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( function () {return 1;}))->isTrue();		
			
		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( function () {return 1;}))->isTrue();		
			
		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( create_function('$a', 'return $a;')))->isTrue();		
			
		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( function () {return 1;}))->isTrue()
			->boolean( $tpl->setL10nCallback( function () {return 1;}))->isTrue();		

		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( ' '))->isFalse();		

		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( 123))->isFalse();		

		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( 1.23))->isFalse();		

		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( false))->isFalse();		

		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( array()))->isFalse();		

		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( new \stdClass()))->isFalse();		

		$tpl = new \Hyla_Tpl();
		$this->boolean( $tpl->setL10nCallback( null))->isFalse();		
		
	}	
	
    public function testRenderVarVars()
    {
		
		// 1 setVar String
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-0.tpl');
		$tpl->setVar('contenu', 'azerty');
		$this->string($tpl->render())->isEqualTo('azerty');		
		
		// 1 setVar integer
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-0.tpl');
		$tpl->setVar('contenu', 123);
		$this->string($tpl->render())->isEqualTo('123');		
		
		// 1 setVar float
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-0.tpl');
		$tpl->setVar('contenu', 1.23);
		$this->string($tpl->render())->isEqualTo('1.23');		
		
		// 1 setVar boolean true
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-0.tpl');
		$tpl->setVar('contenu', true);
		$this->string($tpl->render())->isEqualTo('1');		
		
		// 1 setVar boolean false
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-0.tpl');
		$tpl->setVar('contenu', false);
		$this->string($tpl->render())->isEqualTo('');		

		// 1 setVar null
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-0.tpl');
		$tpl->setVar('contenu', null);
		$this->string($tpl->render())->isEqualTo('');		
		
		// 1 setVar array
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-1.tpl');
		$tpl->setVar('contenu', array('text' => 'azerty'));
		$this->string($tpl->render())->isEqualTo('azerty');		
		
		// 1 setVar Object
		$obj = new \stdClass();
		$obj->text = 'azerty';
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-1.tpl');
		$tpl->setVar('contenu', $obj);
		$this->string($tpl->render())->isEqualTo('azerty');		
		
		// 1 setVar array of array
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-2.tpl');
		$tpl->setVar('contenu', array('text0' => array( 'text1-0' => '0123','text1-1' => '0123', 'text1-2' => 'azerty','text1-3' => '0123')));
		$this->string($tpl->render())->isEqualTo('azerty');		
		
		
		// 4 setVar
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-3.tpl');
		$tpl->setVar('v1', 'azerty');
		$tpl->setVar('v2', '0123456789');
		$tpl->setVar('v3', '<>&#"\'');
		$tpl->setVar('v4', 'éèàùçëîê');
		$this->string($tpl->render())->isEqualTo('azerty0123456789<>&#"\'éèàùçëîê');		
		
		// 1 setVars
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-3.tpl');
		$tpl->setVars( 
			array(
				'v1' => 'azerty',
				'v2' => '0123456789',
				'v3' => '<>&#"\'',
				'v4' => 'éèàùçëîê'
			));
		$this->string($tpl->render())->isEqualTo('azerty0123456789<>&#"\'éèàùçëîê');		

		// 2 setVars
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-3.tpl');
		$tpl->setVars( 
			array(
				'v1' => 'azerty',
				'v2' => '0123456789',
			));
		$tpl->setVars( 
			array(
				'v3' => '<>&#"\'',
				'v4' => 'éèàùçëîê'
			));
		$this->string($tpl->render())->isEqualTo('azerty0123456789<>&#"\'éèàùçëîê');		

		// 1 setVars 2 setVar
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('3-3.tpl');
		$tpl->setVar('v1', 'azerty');
		$tpl->setVar('v2', '0123456789');
		$tpl->setVars( 
			array(
				'v3' => '<>&#"\'',
				'v4' => 'éèàùçëîê'
			));
		$this->string($tpl->render())->isEqualTo('azerty0123456789<>&#"\'éèàùçëîê');		
	}
		
	public function testRenderFunction()
    {
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('6-1.tpl');
		$tpl->setVars( 
			array('vLower' => 'AZERTY',
			'vUpper' => 'azerty',
			'vTrim' => ' azerty ',
			'vRtrim' => 'azerty ',
			'vLtrim' => ' azerty',
			'vUcfirst' => 'azerty azerty',
			'vUcwords' => 'azerty azerty'));
		$this->string($tpl->render())->isEqualTo('lower:azerty upper:AZERTY trim:azerty rtrim:azerty ltrim:azerty ucfirst:Azerty azerty ucwords:Azerty Azerty');		
	
		// setVar, registerVarFunction
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('6-2.tpl');
		$tpl->setVar('v1', 'azerty');
		$tpl->registerVarFunction('quote', function ($var) {return "« $var »";});		
		$this->string($tpl->render())->isEqualTo('« azerty »');		
		
		// setVar, undefined function quote
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('6-2.tpl');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render())->isEqualTo('');		
		
		// undefined var, registerVarFunction
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('6-2.tpl');
		$tpl->registerVarFunction('quote', function ($var) {return "« $var »";});		
		$this->string($tpl->render())->isEqualTo('«  »');		
		
		// !setvar
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('6-3.tpl');
		$this->string($tpl->render())->isEqualTo( file_get_contents('template/6-3.txt'));	
		
		// default value
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('6-4.tpl');
		$this->string($tpl->render())->isEqualTo( '01234567890123456789');	

		// # commentaire
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('6-5.tpl');
		$this->string($tpl->render())->isEqualTo( '');	
	
	}	
	public function testRenderL10n()
    {
		global $lang;
		
		$tpl = new \Hyla_Tpl('template');
		$lang = 'en';
		$tpl->importFile('3-8.tpl');
		$this->string($tpl->render())->isEqualTo( 'Hello');	
		
		$tpl = new \Hyla_Tpl('template');
		$lang = 'en';
		$tpl->setL10nCallback( 
				function ( $val) {
					global $lang;
					if( $lang == 'fr') {
						return 'Bonjour';
					} else {
						return $val;
					}
				}
			);		
		$tpl->importFile('3-8.tpl');
		$this->string($tpl->render())->isEqualTo( 'Hello');	
		
		$tpl = new \Hyla_Tpl('template');
		$lang = 'fr';
		$tpl->setL10nCallback( 
				function ( $val) {
					global $lang;
					if( $lang == 'fr') {
						return 'Bonjour';
					} else {
						return $val;
					}
				}
			);		
		$tpl->importFile('3-8.tpl');
		$this->string($tpl->render())->isEqualTo( 'Bonjour');	
	
	}	
	
	public function testRenderBlockSimple()
    {
		// search block
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('5-1.tpl');
		$this->string($tpl->render('b1'))->isEqualTo( 'azerty');	
		$this->string($tpl->render('b1', true))->isEqualTo( 'azertyazerty');	
		$this->string($tpl->render('b1', false))->isEqualTo( 'azerty');	
		
		// search block not exist
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-1.tpl');
		$this->string($tpl->render('b2'))->isEqualTo( '');	
		$this->string($tpl->render('b2', true))->isEqualTo( '');	
		$this->variable($tpl->render('b2', false))->isNull();	
		
		// search bad block 
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-2.tpl');
		$this->string( $tpl->render('b1'))->isEqualTo('');	
		$this->string( $tpl->render('b1', true))->isEqualTo('');	
		$this->variable( $tpl->render('b1', false))->isNull();	
		
		// search bad block 
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-3.tpl');
		$this->string( $tpl->render('b1'))->isEqualTo('');	
		$this->string( $tpl->render('b1', true))->isEqualTo('');	
		$this->variable( $tpl->render('b1', false))->isNull();	
		
		// search bad block 
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-4.tpl');
		$this->string( $tpl->render('b1'))->isEqualTo('');	
		$this->string( $tpl->render('b1', true))->isEqualTo('');	
		$this->variable( $tpl->render('b1', false))->isNull();	
		
		// search bad block 
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-5.tpl');
		$this->string( $tpl->render('b1'))->isEqualTo('');	
		$this->string( $tpl->render('b1', true))->isEqualTo('');	
		$this->variable( $tpl->render('b1', false))->isNull();	
		
		// 3 blocks 
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-6.tpl');
		$this->string( $tpl->render('b2'))->isEqualTo('b2')	
			->string( $tpl->render('b2', true))->isEqualTo('b2b2')	
			->string( $tpl->render('b2', false))->isEqualTo('b2')	
			->string( $tpl->render('b1'))->isEqualTo('b1')	
			->string( $tpl->render('b1', true))->isEqualTo('b1b1')	
			->string( $tpl->render('b1', false))->isEqualTo('b1')	
			->string( $tpl->render('b3'))->isEqualTo('b3')	
			->string( $tpl->render('b3', true))->isEqualTo('b3b3')	
			->string( $tpl->render('b3', false))->isEqualTo('b3');	
		
		// 6 blocks 
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-7.tpl');
		$this->string( $tpl->render('b2'))->isEqualTo('b2')	
			->string( $tpl->render('b2', true))->isEqualTo('b2b2')	
			->string( $tpl->render('b2', false))->isEqualTo('b2')	
			->string( $tpl->render('b1'))->isEqualTo('b1')	
			->string( $tpl->render('b1', true))->isEqualTo('b1b1')	
			->string( $tpl->render('b1', false))->isEqualTo('b1')	
			->string( $tpl->render('b3'))->isEqualTo('b3')	
			->string( $tpl->render('b3', true))->isEqualTo('b3b3')	
			->string( $tpl->render('b3', false))->isEqualTo('b3')	
			->string( $tpl->render('b1.1'))->isEqualTo('b1.1')	
			->string( $tpl->render('b1.1', true))->isEqualTo('b1.1b1.1')	
			->string( $tpl->render('b1.1', false))->isEqualTo('b1.1')	
			->string( $tpl->render('b1.1.2'))->isEqualTo('b1.1.2')	
			->string( $tpl->render('b1.1.2', true))->isEqualTo('b1.1.2b1.1.2')	
			->string( $tpl->render('b1.1.2', false))->isEqualTo('b1.1.2');	
	/*	
		//
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( true);
		$tpl->logError( false);
		$this->string( $tpl->render('5-6.tpl:b2'))->isEqualTo('b2')	
			->string( $tpl->render('5-6.tpl:b2', true))->isEqualTo('b2b2')	
			->string( $tpl->render('5-6.tpl:b2', false))->isEqualTo('b2')	
			->string( $tpl->render('5-6.tpl:b1'))->isEqualTo('b1')	
			->string( $tpl->render('5-6.tpl:b1', true))->isEqualTo('b1b1')	
			->string( $tpl->render('5-6.tpl:b1', false))->isEqualTo('b1')	
			->string( $tpl->render('5-6.tpl:b3'))->isEqualTo('b3')	
			->string( $tpl->render('5-6.tpl:b3', true))->isEqualTo('b3b3')	
			->string( $tpl->render('5-6.tpl:b3', false))->isEqualTo('b3')	
			->string( $tpl->render('5-6.tpl:b1.1'))->isEqualTo('b1.1')	
			->string( $tpl->render('5-6.tpl:b1.1', true))->isEqualTo('b1.1b1.1')	
			->string( $tpl->render('5-6.tpl:b1.1', false))->isEqualTo('b1.1')	
			->string( $tpl->render('5-6.tpl:b1.1.2'))->isEqualTo('b1.1.2')	
			->string( $tpl->render('5-6.tpl:b1.1.2', true))->isEqualTo('b1.1.2b1.1.2')	
			->string( $tpl->render('5-6.tpl:b1.1.2', false))->isEqualTo('b1.1.2');	
	*/	
		//
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( false);
		$tpl->importFile('5-7.tpl');
		$tpl->importFile('5-6.tpl');
		$tpl->setCurrentFile('5-7.tpl');
		$this->string( $tpl->render('b2'))->isEqualTo('b2')	
			->string( $tpl->render('b2', true))->isEqualTo('b2b2')	
			->string( $tpl->render('b2', false))->isEqualTo('b2')	
			->string( $tpl->render('b1'))->isEqualTo('b1')	
			->string( $tpl->render('b1', true))->isEqualTo('b1b1')	
			->string( $tpl->render('b1', false))->isEqualTo('b1')	
			->string( $tpl->render('b3'))->isEqualTo('b3')	
			->string( $tpl->render('b3', true))->isEqualTo('b3b3')	
			->string( $tpl->render('b3', false))->isEqualTo('b3')	
			->string( $tpl->render('b1.1'))->isEqualTo('b1.1')	
			->string( $tpl->render('b1.1', true))->isEqualTo('b1.1b1.1')	
			->string( $tpl->render('b1.1', false))->isEqualTo('b1.1')	
			->string( $tpl->render('b1.1.2'))->isEqualTo('b1.1.2')	
			->string( $tpl->render('b1.1.2', true))->isEqualTo('b1.1.2b1.1.2')	
			->string( $tpl->render('b1.1.2', false))->isEqualTo('b1.1.2');	
	}
	
	public function testRenderBlock()
    {
		// search block with 1 block 1 variable 1 reference
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('7-0.tpl');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render())->isEqualTo( '0123456789ABCDEF')
			->string($tpl->render('b1', true))->isEqualTo( 'azerty')
			->string($tpl->render('b1', true))->isEqualTo( 'azertyazerty')
			->string($tpl->render('b1', false))->isEqualTo( 'azerty');	
		
		// search block with 2 blocks 1 variable 2 references
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('7-1.tpl');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render())->isEqualTo( '0123456789ABCDEF')
			->string($tpl->render('b1', true))->isEqualTo( 'azerty')
			->string($tpl->render('b1', true))->isEqualTo( 'azertyazerty')
			->string($tpl->render('b1', false))->isEqualTo( 'azerty');	
		
		// search block with 2 blocks 1 variable 3 references
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('7-2.tpl');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render())->isEqualTo( '0123456789azertyABCDEF')
			->string($tpl->render('b1', true))->isEqualTo( 'azerty')
			->string($tpl->render('b1', true))->isEqualTo( 'azertyazerty')
			->string($tpl->render('b1', false))->isEqualTo( 'azerty');	

		// search block with 2 blocks 1 variable 3 references
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('7-2.tpl');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render('b1', true))->isEqualTo( 'azerty')
			->string($tpl->render())->isEqualTo( '0123456789azertyazertyABCDEF');
		
		// search block with 2 blocks 1 variable 3 references
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('7-2.tpl');
		$this->string($tpl->render('b1', false))->isEqualTo( '');
		$this->string($tpl->render('b1', true))->isEqualTo( '');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render())->isEqualTo( '0123456789azertyABCDEF');
		
		// search block with else
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('7-4.tpl');
		$this->string($tpl->render())->isEqualTo( '0123456789')	
			->string($tpl->render('b1', true))->isEqualTo( 'azerty')
			->string($tpl->render('b1', false))->isEqualTo( 'azerty');	
	}
	
	public function testHylaTplError()
    {
		$tpl = new \Hyla_Tpl('template');
		$this->boolean($tpl->displayError( false))->isFalse()
			->boolean($tpl->logError( false))->isFalse()
			->boolean($tpl->displayError( true))->isTrue()
			->boolean($tpl->logError( true))->isTrue();

		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('8-0.tpl');
		$tpl->displayError( false);
		$tpl->logError( true);
		$this->string($tpl->render())->isEqualTo( '');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( true);
		$tpl->importFile('noexist.tpl');
		$tpl->importFile('8-0.tpl');
		$this->string($tpl->render())->contains( 'template/noexist.tpl');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( true);
		$tpl->importFile('8-0.tpl');
		$tpl->render('b1');
		$this->string($tpl->render())->contains( 'b1');
				
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( true);
		$tpl->importFile('6-2.tpl');
		$tpl->setVar('v1', 'azerty');
		$tpl->render();
		$tpl->importFile('8-0.tpl');
		$this->string($tpl->render())->contains( 'quote');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->displayError( false);
		$tpl->logError( true);
		$tpl->importFile('noexist.tpl');
		$tpl->importFile('6-2.tpl');
		$tpl->setVar('v1', 'azerty');
		$tpl->render();
		$tpl->importFile('8-0.tpl');
		$tpl->render('b1');
		$this->string($tpl->render())
			 ->contains( 'quote')
			 ->contains( 'b1')
			 ->contains( 'template/noexist.tpl');
	}
	
	public function testGet()
    {
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('1.tpl');
		$this->string($tpl->get())->isEqualTo('<h1>1.tpl</h1>');
		
	}
	/*
	public function testIncludeImport()
    {
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('9-0.tpl');
		$this->string($tpl->render())->isEqualTo('azerty');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('9-2.tpl');
		$this->string($tpl->render())->isEqualTo('azerty');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('9-3.tpl');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render())->isEqualTo('azerty');
		
		$tpl = new \Hyla_Tpl('template');
		$tpl->importFile('9-5.tpl');
		$tpl->setVar('v1', 'azerty');
		$this->string($tpl->render())->isEqualTo('azerty');
	}
	 * 
	 */
}
