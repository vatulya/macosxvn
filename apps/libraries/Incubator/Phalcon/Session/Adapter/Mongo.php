<?php
/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/
namespace Phalcon\Session\Adapter;

use Phalcon\Session\Adapter;
use Phalcon\Session\AdapterInterface;
use Phalcon\Session\Exception;

/**
 * Phalcon\Session\Adapter\Mongo
 * Mongo adapter for Phalcon\Session
 */
class Mongo extends Adapter implements AdapterInterface
{

    /**
     * Class constructor.
     *
     * @param array $options
     */
    public function __construct($options = null)
    {
        if (!isset($options['collection'])) {
            throw new Exception("The parameter 'collection' is required");
        }

        session_set_save_handler(
            array($this, 'open'),
            array($this, 'close'),
            array($this, 'read'),
            array($this, 'write'),
            array($this, 'destroy'),
            array($this, 'gc')
        );

        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function open()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function close()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     *
     * @param  string $sessionId
     * @return string
     */
    public function read($sessionId)
    {
        $options = $this->getOptions();

        $sessionData = $options['collection']->findOne(array('session_id' => $sessionId));
        if (is_array($sessionData)) {
            return $sessionData['data'];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     *
     * @param string $sessionId
     * @param string $data
     */
    public function write($sessionId, $data)
    {
        $options = $this->getOptions();

        $sessionData = $options['collection']->findOne(array('session_id' => $sessionId));
        if (is_array($sessionData)) {
            $sessionData['data'] = $data;
        } else {
            $sessionData = array('session_id' => $sessionId, 'data' => $data);
        }

        $options['collection']->save($sessionData);

    }

    /**
     * {@inheritdoc}
     */
    public function destroy($session_id = null)
    {
        if (is_null($session_id)) {
            $session_id = session_id();
        }
        
        $options = $this->getOptions();
        $sessionData = $options['collection']->findOne(array('session_id' => $session_id));
        if (is_array($sessionData)) {
            $options['collection']->remove($sessionData);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function gc()
    {
    }
}
