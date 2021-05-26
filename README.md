# CA-Test Eduardo Lera Diaz

## Requirements
 - An environment with GIT, PHP7.4, MYSQL and Composer

## Installation
 - clone repo: git clone git@github.com:EduardoLeraDiaz/ca-test.git
 - run: composer install
 - fill in the .env file  the parameter DATABASE_URL with proper values to reach the database
 - run: make db
 - start the dev server by running: bin/console server:run
 - open in a browser the addres that the command above will show you. 

## About the test and the tech staff

#### PHP 7.4
It is the actual version that I use so no considerations about it. 

#### Symfony 5 and doctrine
I used the standard structures of directories of symfony for the test. 
I find it good for microservices or small projects. For things that they will to grow I would use a more adavanced structure of directories with DDD to sepate concepts and make it more easy to understand when it becomes big.
I just used the a dev environment and of course a project designed to work on prod must have different env files without passwords or so on files who are on the repo. 
For the test about it I used the PHP Spec as unit test as I used since years ago.

#### webpack and jest
Unfortunately that's the first time that I had to set a webpack file for a project. That part was always done when I entered a project.
I make a simple file  who works for the JS but for the js but for the scss I use directly the sass command installed globally on my system. 


#### VueJS 2
I keept is simple and I didn't add a router as we only wanted one.

#### TypeScript
There's no typescript in the project were I worked so I used normal javascript. 

#### NPM
I didn't set the script parts of the project and I didn't "clean" it after.  
As that's not a real project and I committed the css and js files they are not needed. 

#### BEM SCSS with flex
I used BEM on the classes that I wrote on the template, for the flex grid I just picked up the one from bootstrap

#### jest
I had a similar problem than with webpack, I was not abel to configure it in the way I can run the test.
Jest was already configured in the project were I worked and I underestimated the problems that we can face when we set things for a new project. 
I wrote two jest test and I think that they can give you an idea about how I worked with them. For the page itself I don't use mocks, so I test not only the unit. The integration with the components is tested too.
For componentes like the Store everything is mocked so they work like unit test. 

#### Conclusions
Even I used more time that I estimate I didn't get the results that I wanted on every technology.
The good point of it is that I've learned a lot about my weak points and you can evaluate if my skills fits for you company. 





