<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
 
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
    Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's URLs.
 */
    Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
    CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
    require CAKE . 'Config' . DS . 'routes.php';

   //Instructors
   Router::connect('/instructors', ['controller' => 'instructors', 'action' => 'add']);
   Router::connect('/instructors/*', ['controller' => 'instructors', 'action' => 'edit']);
   Router::connect('/instructors/login', ['controller' => 'instructors', 'action' => 'login']);
   //Courses
   Router::connect('/courses/add', ['controller' => 'courses', 'action' => 'add']);
   Router::connect('/courses/show_list/*', ['controller' => 'courses', 'action' => 'show_list']);
   Router::connect('/courses/edit/*', ['controller' => 'courses', 'action' => 'edit']);
   Router::connect('/courses/delete/*', ['controller' => 'courses', 'action' => 'delete']);
   Router::connect('/courses/download_csv/*', ['controller' => 'courses', 'action' => 'download_csv']);
   //Attendance
   Router::connect('/attendances/show_list/*', ['controller' => 'attendances', 'action' => 'show_list']);
   Router::connect('/attendances/add', ['controller' => 'attendances', 'action' => 'add']);
   Router::connect('/attendances/edit', ['controller' => 'attendances', 'action' => 'edit']);
   //Students
   Router::connect('/students/edit/*', ['controller' => 'students', 'action' => 'edit']);
   Router::connect('/students/add', ['controller' => 'students', 'action' => 'add']);
   Router::connect('/students/search/*', ['controller' => 'students', 'action' => 'search']);
   Router::connect('/students/delete/*', ['controller' => 'students', 'action' => 'delete']);
   Router::connect('/students/final_grade/*', ['controller' => 'students', 'action' => 'final_grade']);
   Router::connect('/students/upload_csv/*', ['controller' => 'students', 'action' => 'upload_csv']);
   // Criteria
   Router::connect('/criteria/edit/*', ['controller' => 'criteria', 'action' => 'edit']);
   Router::connect('/criteria/add', ['controller' => 'criteria', 'action' => 'add']);
   Router::connect('/criteria/show_list/*', ['controller' => 'criteria', 'action' => 'show_list']);
   Router::connect('/criteria/delete/*', ['controller' => 'criteria', 'action' => 'delete']);
   //Activities
   Router::connect('/activities/edit/*', ['controller' => 'activities', 'action' => 'edit']);
   Router::connect('/activities/add', ['controller' => 'activities', 'action' => 'add']);
   Router::connect('/activities/show_list/*', ['controller' => 'activities', 'action' => 'show_list']);
   Router::connect('/activities/delete/*', ['controller' => 'activities', 'action' => 'delete']);
   //ActivitieResults
   Router::connect('/activity_results/edit', ['controller' => 'ActivityResults', 'action' => 'edit']);
   Router::connect('/activity_results/add', ['controller' => 'ActivityResults', 'action' => 'add']);
   Router::connect('/activity_results/show_list/*', ['controller' => 'ActivityResults', 'action' => 'show_list']);
   Router::parseExtensions();