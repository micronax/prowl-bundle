<?php

namespace Micronax\ProwlBundle;

use Symfony\Component\DependencyInjection as DI;

class ProwlClient
{
    private $container; // Symfony container
    private $debug = false;

    /**
     * @param DI\ContainerInterface $container
     * @param \Prowl\Connector $oProwl
     * @param \Prowl\Message $oMsg
     */
    public function __construct(DI\ContainerInterface $container, \Prowl\Connector $oProwl, \Prowl\Message $oMsg)
    {
        $this->container =& $container;

        $this->oProwl = $oProwl;
        $this->oMsg = $oMsg;

        $this->debug = (bool)$this->container->getParameter('prowl.debug');
    }

    /**
     * Send Prowl Notification with specific title / description / priority
     *
     * @param $_title
     * @param string $_description
     * @param int $_priority
     * @return bool
     */
    public function notify($_title, $_description = "", $_priority = 0)
    {
        try {
            $this->oProwl->setFilterCallback(
                function ($sText) {
                    return $sText;
                }
            );

            $this->oMsg
                ->setPriority($_priority)
                ->setEvent($_title)
                ->setDescription($_description);

            $oResponse = $this->oProwl->push($this->oMsg);
            if ($oResponse->isError()) {
                if ($this->debug) {
                    print $oResponse->getErrorAsString();
                } else {
                    return false;
                }
            } else {
                if ($this->debug) {
                    print "Message sent." . PHP_EOL;
                    print "You have " . $oResponse->getRemaining() . " Messages left." . PHP_EOL;
                    print "Your counter will be resetted on " . date(
                            'Y-m-d H:i:s',
                            $oResponse->getResetDate()
                        ) . PHP_EOL;
                } else {
                    return true;
                }
            }
        } catch (\InvalidArgumentException $oIAE) {
            if ($this->debug) {
                print $oIAE->getMessage();
            } else {
                return false;
            }
        } catch (\OutOfRangeException $oOORE) {
            if ($this->debug) {
                print $oOORE->getMessage();
            } else {
                return false;
            }
        }
    }
}