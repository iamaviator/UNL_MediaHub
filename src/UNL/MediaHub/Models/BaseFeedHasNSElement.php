<?php

abstract class UNL_MediaHub_Models_BaseFeedHasNSElement extends Doctrine_Record
{

    public function setTableDefinition()
    {
        $this->setTableName('feed_has_nselement');
        $this->hasColumn('feed_id',    'integer',    4, array('unsigned' => 0, 'primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->hasColumn('xmlns',      'string',  null, array('primary' => true, 'notnull' => true, 'autoincrement' => false));
        $this->hasColumn('element',    'string',  null, array('primary' => true, 'notnull' => true, 'autoincrement' => false));
        $this->hasColumn('attributes', 'array',   null, array('primary' => false, 'notnull' => false, 'autoincrement' => false));
        $this->hasColumn('value',      'string',  null, array('primary' => false, 'notnull' => false, 'autoincrement' => false));
        
        $this->setSubclasses(array(
                'UNL_MediaHub_Feed_NamespacedElements_itunes'   => array('xmlns' => 'itunes'),
                'UNL_MediaHub_Feed_NamespacedElements_media'    => array('xmlns' => 'media'),
                'UNL_MediaHub_Feed_NamespacedElements_boxee'    => array('xmlns' => 'boxee')
            )
        );
    
    }
    
    public function setUp()
    {
        $this->hasOne('UNL_MediaHub_Feed',  array('local'   => 'feed_id',
                                                  'foreign' => 'id'));
        parent::setUp();
    }
  
    function preInsert($event)
    {
        if (empty($this->value) && empty($this->attributes)) {
            $event->skipOperation();
            return;
        }
    }
    
    function preUpdate($event)
    {
        if (empty($this->value) && $this->attributes) {
            $this->delete();
            $event->skipOperation();
            return;
        }
    }
}
