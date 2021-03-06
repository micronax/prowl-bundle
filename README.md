MicronaxProwlBundle
================

This bundle provides a simple integration of the "[Prowl Library](https://github.com/xenji/ProwlPHP)" from Mario Mueller into Symfony2. 

    <?php

    $prowl = $this->container->get('prowl');

The bundle provides a new `prowl` service.

## Installation

You need an prowlapp.com API-Key to use this software!  

Installing the bundle via packagist is the quickest and simplest method of installing the bundle. Here are the steps:

### Step 1: Composer require

    $ php composer.phar require "micronax/prowl-bundle":"dev-master"

### Step 2: Enable the bundle in the kernel

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Micronax\ProwlBundle\MicronaxProwlBundle(),
            // ...
        );
    }

### Step 3: Configure your parameters

Just add the following to your config.yml

    micronax_prowl:
        debug: false
        provider_key: <your provider key>
        api_key: <your api key>
        app_name: <Applicatio Name>


## Usage
Usage is as simple as possible. Just call the following line of code everywhere in your application where you want to send prowl messages:

    $this->get('prowl')->notify('MESSAGE SUBJECT', 'MESSSAGE TEXT', 2);
    // where "3" represents an integer priority in between -2 (very low) and 2 (emergency)
