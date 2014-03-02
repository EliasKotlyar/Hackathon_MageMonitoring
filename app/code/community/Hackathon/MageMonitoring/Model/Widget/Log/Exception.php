<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Hackathon
 * @package     Hackathon_MageMonitoring
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Hackathon_MageMonitoring_Model_Widget_Log_Exception extends Hackathon_MageMonitoring_Model_Widget_Log_Abstract
                                                          implements Hackathon_MageMonitoring_Model_Widget_Log,
                                                                     Hackathon_MageMonitoring_Model_WatchDog
{
    protected $_DEF_LOG_LINES = 60;
    protected $_DEF_DISPLAY_PRIO = 20;

    /**
     * (non-PHPdoc)
     * @see Hackathon_MageMonitoring_Model_Widget::getName()
     */
    public function getName()
    {
        return 'Magento Exception Log';
    }

    /**
     * (non-PHPdoc)
     * @see Hackathon_MageMonitoring_Model_Widget::getVersion()
     */
    public function getVersion()
    {
        return '1.0';
    }

    /**
     * (non-PHPdoc)
     * @see Hackathon_MageMonitoring_Model_Widget::getOutput()
     */
    public function getOutput()
    {
        $this->_output[] = $this->newLogBlock('error', Mage::getStoreConfig('dev/log/exception_file'));
        return $this->_output;
    }

    /**
     * Reports on new log entries.
     *
     * (non-PHPdoc)
     * @see Hackathon_MageMonitoring_Model_WatchDog::watch()
     */
    public function watch()
    {
        $logName = Mage::getStoreConfig('dev/log/exception_file');
        $log = $this->getLogTail($logName, $this->getConfig(self::CONFIG_LOG_LINES));
        return $this->watchLog($log, $logName);
    }

}
