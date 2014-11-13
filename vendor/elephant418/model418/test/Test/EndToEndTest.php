<?php

namespace Test\Model418\Test;

use Test\Model418\Resources\SimpleCase\ResourceModel as SimpleModel;
use Test\Model418\Resources\SeparateCase\ResourceModel as SeparateModel;
use Test\Model418\Resources\NoProviderCase\ResourceModel as NoProviderModel;
use Test\Model418\Resources\JSONCase\ResourceModel as JSONModel;
use Test\Model418\Resources\SubAttributeCase\ResourceModel as SubAttributeModel;
use Test\Model418\Resources\MdAttributeCase\ResourceModel as MdAttributeModel;

class EndToEndTest extends \PHPUnit_Framework_TestCase
{
    
    public function testSimpleAccessor()
    {
        $model = (new SimpleModel)->query()->fetchById('test');
        $this->assertEquals('myValue', $model['myName'], 'Get model attribute value with array accessor');
        $this->assertEquals('myValue', $model->myName, 'Get model attribute value with object accessor');
        $this->assertEquals('myValue', $model->get('myName'), 'Get model attribute value with method accessor');
    }

    public function testSimpleCustomFetch()
    {
        $model = (new SimpleModel)->query()->fetchTest();
        $this->assertEquals('myValue', $model->myName);
    }
    
    public function testSeparate()
    {
        $model = (new SeparateModel)->query()->fetchTest();
        $this->assertEquals('myValue', $model->myName);
    }
    
    public function testNoProvider()
    {
        $this->setExpectedException('LogicException');
        (new NoProviderModel)->query()->fetchById('test');
    }
    
    public function testSaveAndDelete()
    {
        $model = new SimpleModel;
        $model->myName = 'truc';
        $this->assertFalse($model->exists(), 'The model does not exist');
        
        $this->assertEquals('truc', $model->myName);
        $model->save();
        $this->assertTrue($model->exists(), 'The model exists');
        
        $id = $model->id;
        unset($model);
        $model = (new SimpleModel)->query()->fetchById($id);
        $this->assertTrue($model->exists(), 'The model exists');
        
        $this->assertEquals('truc', $model->myName);
        $model->delete();
        unset($model);
        $model = (new SimpleModel)->query()->fetchById($id);
        $this->assertFalse($model->exists(), 'The model exists');
    }

    public function testJSONDataSource()
    {
        $model = (new JSONModel)->query()->fetchTest();
        $this->assertTrue($model->exists(), 'The model exists');
        $this->assertEquals('myValue', $model->myName);
    }

    public function testFetchSubAttribute()
    {
        $model = (new SimpleModel)->query()->fetchTest();
        $this->assertNull($model->get('event'), 'model `event` attribute is null');
        
        $model = (new SubAttributeModel)->query()->fetchTest();
        $this->assertTrue(is_array($model->get('event')), 'model `event` attribute is an array');
        $this->assertTrue(isset($model->event['created']), 'model `event` value is retrieved');
    }

    public function testSaveSubAttribute()
    {
        (new SubAttributeModel)
            ->query()
            ->fetchTest()
            ->duplicate()
            ->save();
        $model = (new SimpleModel)
            ->query()
            ->fetchById('myValue');
        $this->assertTrue($model->exists(), 'model `myValue` exists');
        $this->assertNull($model->event, 'model `event` attribute is null');
        
        $model = (new SubAttributeModel)
            ->query()
            ->fetchById('myValue');
        $this->assertTrue(is_array($model->get('event')), 'model `event` attribute is an array');
        
        $model->delete();
        $model = (new SimpleModel)
            ->query()
            ->fetchById('myValue');
        $this->assertFalse($model->exists(), 'model `myValue` should not exist anymore');
    }

    public function testFetchMdAttribute()
    {
        $model = (new SimpleModel)->query()->fetchTest();
        $this->assertNull($model->article, 'model `content` attribute is null');

        $model = (new MdAttributeModel)->query()->fetchTest();
        $this->assertTrue(is_string($model->content), 'model `content` attribute is a string');
    }

    public function testSaveMdAttribute()
    {
        $model = (new MdAttributeModel)
            ->query()
            ->fetchTest()
            ->duplicate()
            ->set('content', '<h3>Coco</h3>')
            ->save();
        $md = file_get_contents(__DIR__.'/../Resources/data/myValue.article.md');
        $this->assertEquals('### Coco', $md, 'model `content` attribute is converted to Markdown');
        $model->delete();
    }
}