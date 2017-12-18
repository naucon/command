naucon Command Package
======================

About
-----

This package provides a generic command pattern to execute actions or tasks. The goal is to split large business logic into smaller actions/task which are loosely decoupled, more readable, easy to maintain and quick to replace.


### Compatibility

* PHP5.5+


Installation
------------

install the latest version via composer

    composer require naucon/command


Usage
-----

create CommandManager instance

    $manager = new CommandManager();

register commands to the manager instance

    $manager->register('foo', new FooAction());
    $manager->register('bar', new BarAction());

execute command

    $request = new FooRequest();

    $response = $manager->execute($request)

create a request

    class MyRequest
    {
    
    }


create a action (command)

    use Naucon\Command\CommandInterface;

    class MyAction implements CommandInterface
    {
        /**
         * @param mixed $request
         * @return mixed response
         */
        public function execute($request)
        {
            // do something ....
           
            return true;
        }
    
        /**
         *
         * @param mixed $request
         * @return bool     returns true if request is support, else false
         */
        public function support($request)
        {
            return $model instanceof MyRequest;
        }
    }

Data should be generally passed through the `Request` to the `Action`.

    class PowerOnRequest
    {
        /**
         * @var Light
         */
        protected $light;
    
        /**
         * Constructor
         *
         * @param Light $light
         */
        public function __construct(Light $light)
        {
            $this->light = $light;
        }
    
        /**
         * @return Light
         */
        public function getLight()
        {
            return $this->light;
        }
    }

To execute an `Action` within a `Action` the class requires an instance of the `CommandManager`. To inject the `CommandManager` implement the `CommandManagerAwareInterface` to the `Action`. 
The interface triggers the `CommandHydrator` to inject the `CommandManager` into the `Action` by calling `setCommandManager()`. The `CommandManagerAwareTrait` can be used to add property and setter.  

    class MyAction implements CommandInterface, CommandManagerAwareInterface
    {
        use CommandManagerAwareTrait;
    
        ...

        public function execute($request)
        {
            $request = new MySubRequest();
            $response = $this->commandManager->execute($request);
            return $response;
        }

To inject other types of data into actions you can add custom processors to the `CommandHydrator`. Processor must implement the `ProcessorInterface`.
Add a custom processor by calling `CustomerManager::addProcessor()`. Second argument is an optional `$priority` (`default = 0`).

    $manager = new CommandManager();
    $manager->addProcessor(new MyProcessor());

In some rare cases with nested sub requests it can be necessary to break the workflow and immediately send a http response or redirect (generally not recommended).
Therefore a `LogicException` that implements `ResponseInterface` can be thrown within the action (command).

    use Naucon\Command\CommandInterface;
    use Naucon\Command\Response\HttpRedirect;

    class MyAction implements CommandInterface
    {
        /**
         * @param mixed $request
         * @return mixed response
         */
        public function execute($request)
        {
            // do something ....
           
            throw new HttpRedirect($url, $statusCode, $headers);
            
            // or
            
            throw new HttpResponse($content, $statusCode, $headers);
        }
    ...

Example
-------

Start the build-in webserver to see the examples in action:

    cd examples
    php -S 127.0.0.1:3000

open url in browser

    http://127.0.0.1:3000/index.html


## Credits

This implementation was heavily inspired by the payum payment processing library.
The modular and decoupled architecture can not only be used for processing payment it is also useful in many other use cases.


## License

The MIT License (MIT)

Copyright (c) 2015 Sven Sanzenbacher

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.