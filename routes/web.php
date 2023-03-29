<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/calendar', [\App\Http\Controllers\MasterController::class, "index"]);
Route::get('/master/get-data', [\App\Http\Controllers\MasterController::class, "getData"]);

Route::get('/signin', [\App\Http\Controllers\UserController::class, "signin"]);
Route::post('/signin_postback', [\App\Http\Controllers\UserController::class, "signin_postback"]);
Route::get('/signout', [\App\Http\Controllers\UserController::class, "signout"]);
Route::get('/signout_postback', [\App\Http\Controllers\UserController::class, "signout_postback"]);
Route::post('/userform/insert', [\App\Http\Controllers\UserformController::class, "insert"]);
Route::post('userpermission/update', [\App\Http\Controllers\UserformController::class, "permissionupdate"]);
Route::post('userpermission/delete', [\App\Http\Controllers\UserformController::class, "permissiondelete"]);
Route::post('/userform/insertstatus', [\App\Http\Controllers\UserformController::class, "insertstatus"]);
Route::get('/createstatus', [\App\Http\Controllers\UserformController::class, "createstatus"]);
Route::get('/userform', [\App\Http\Controllers\UserformController::class, "index"]);
Route::get('/nav', [\App\Http\Controllers\navController::class, "index"]);

Route::get('/assignedit', [\App\Http\Controllers\AssignController::class, "assignedit"]);
Route::get('/eventshare', [\App\Http\Controllers\AssignController::class, "shareevent"]);
Route::post('/eventshare/reject', [\App\Http\Controllers\AssignController::class, "shareeventreject"]);
Route::post('/eventshare/accept', [\App\Http\Controllers\AssignController::class, "shareeventaccept"]);
Route::get('eventshare/member/{id}', [\App\Http\Controllers\AssignController::class, "sharemember"]);
Route::post('/assignedit/update', [\App\Http\Controllers\AssignController::class, "assignupdate"]);
Route::get('/assignshow/assign/{id}', [\App\Http\Controllers\AssignController::class, "assignshow"]);
Route::get('/main', [\App\Http\Controllers\MasterController::class, "index"]);
Route::get('/addtask', [\App\Http\Controllers\AddTaskController::class, "index"]);
Route::post('/addtask/insert', [\App\Http\Controllers\AddTaskController::class, "insert"]);
Route::post('/task/update', [\App\Http\Controllers\TaskController::class, "taskupdate"]);
Route::post('/task/cancel', [\App\Http\Controllers\TaskController::class, "cancel"]);
Route::post('/task/cancel/group', [\App\Http\Controllers\TaskController::class, "cancelgroup"]);
Route::post('/task/cancel/share', [\App\Http\Controllers\TaskController::class, "cancelshare"]);
Route::post('/task/cancel/assign', [\App\Http\Controllers\TaskController::class, "cancelassign"]);
Route::post('/task/update/adayoff', [\App\Http\Controllers\TaskController::class, "taskupdateadayoff"]);
Route::post('/task/update/share', [\App\Http\Controllers\TaskController::class, "taskupdateshare"]);
Route::post('/task/update/assign', [\App\Http\Controllers\TaskController::class, "taskupdateassign"]);
Route::get('/task', [\App\Http\Controllers\TaskController::class, "index"]);
Route::post('/task/deletetask', [\App\Http\Controllers\TaskController::class, "deletetask"]);
Route::post('/task/deleteusershare', [\App\Http\Controllers\TaskController::class, "deleteusershare"]);
Route::post('/task/deletetask/adayoff', [\App\Http\Controllers\TaskController::class, "deleteadayoff"]);
Route::post('/task/shareevent', [\App\Http\Controllers\TaskController::class, "shareevent"]);
Route::post('/task/shareevent/shareedit', [\App\Http\Controllers\TaskController::class, "shareeventshareedit"]);
Route::get('/shareme', [\App\Http\Controllers\SharedmeController::class, "index"]);
Route::get('/recent', [\App\Http\Controllers\RecentController::class, "index"]);
Route::get('/assign', [\App\Http\Controllers\AssignController::class, "index"]);
Route::post('/assign/reject', [\App\Http\Controllers\AssignController::class, "reject"]);
Route::post('/assign/accept', [\App\Http\Controllers\AssignController::class, "accept"]);
Route::get('/adminaddtask', [\App\Http\Controllers\AdminAddTaskController::class, "index"]);
Route::get('/admincreategroup', [\App\Http\Controllers\AdminCreateGroupController::class, "index"]);
Route::post('/admincreategroup/get-data', [\App\Http\Controllers\AdminCreateGroupController::class, "getData"]);
Route::post('/admincreategroup/insert', [\App\Http\Controllers\AdminCreateGroupController::class, "insert"]);
Route::post('/admincreategroup/adduser', [\App\Http\Controllers\AdminCreateGroupController::class, "adduser"]);
Route::post('/admincreategroup/update', [\App\Http\Controllers\AdminCreateGroupController::class, "update"]);
Route::get('/admincreategroup/delete/{id}', [\App\Http\Controllers\AdminCreateGroupController::class, "deleteuser"]);
Route::get('/admingroup', [\App\Http\Controllers\AdminGroupController::class, "index"]);
Route::get('/supadminaddadmin', [\App\Http\Controllers\SupAdminAddAdminController::class, "index"]);
Route::get('/showadmin', [\App\Http\Controllers\ShowAdminController::class, "index"]);
Route::get('/showuser', [\App\Http\Controllers\ShowUserController::class, "index"]);
Route::get('/follow', [\App\Http\Controllers\FollowController::class, "index"]);
Route::get('/addaffiliate', [\App\Http\Controllers\SupAdminAddAffiliateController::class, "index"]);
Route::get('/affiliate', [\App\Http\Controllers\AffiliateController::class, "index"]);
Route::get('/affiliateadd', [\App\Http\Controllers\AddAffiliateController::class, "index"]);
Route::post('/affiliateadd/adduser', [\App\Http\Controllers\AddAffiliateController::class, "adduser"]);
Route::post('/affiliateadd/get-data', [\App\Http\Controllers\AddAffiliateController::class, "getData"]);
Route::post('/affiliate/deleteaffiliate', [\App\Http\Controllers\AffiliateController::class, "affiliatedelete"]);
Route::post('Affiliate/insert', [\App\Http\Controllers\SupAdminAddAffiliateController::class, "insert"]);
Route::post('Affiliate/update', [\App\Http\Controllers\AffiliateController::class, "update"]);
Route::get('Affiliate/delete/{id}', [\App\Http\Controllers\AffiliateController::class, "delete"]);
Route::get('affiliateadd/deleteuser/{id}', [\App\Http\Controllers\AddAffiliateController::class, "deleteuser"]);
Route::post('Affiliate/updateadmin', [\App\Http\Controllers\AffiliateController::class, "updateadmin"]);
Route::get('/affiliate/show/{id}', [\App\Http\Controllers\AffiliateController::class, "affiliateshow"]);
Route::get('/dashboard', [\App\Http\Controllers\MasterController::class, "dashborad"]);
Route::get('/', [\App\Http\Controllers\MasterController::class, "dashborad"]);
Route::get('/profile', [\App\Http\Controllers\UserController::class, "profile"]);
Route::get('/affiliate/events/{id}', [\App\Http\Controllers\UserController::class, "eventaffiliate"]);
Route::get('/group/events/{id}', [\App\Http\Controllers\UserController::class, "eventgroup"]);
Route::get('/pdf', [\App\Http\Controllers\UserController::class, "pdf"]);
Route::get('/shareedit', [\App\Http\Controllers\AssignController::class, "sharesedit"]);
Route::get('/shareedit/update/{id}', [\App\Http\Controllers\AssignController::class, "shareseditupdate"]);
Route::get('/assignedit/update/{id}', [\App\Http\Controllers\AssignController::class, "assigneditupdate"]);
Route::get('/task/update/{id}', [\App\Http\Controllers\AssignController::class, "taskupdate"]);
Route::get('/eventadayoff/update/{id}', [\App\Http\Controllers\AssignController::class, "eventadayoffupdate"]);
Route::get('/addeventadayoff', [\App\Http\Controllers\AddTaskController::class, "addeventadayoff"]);
Route::get('/linenoti', [\App\Http\Controllers\UserController::class, "linemessage"]);
Route::post('/addtask/insert/adayoff', [\App\Http\Controllers\AddTaskController::class, "insertadayoff"]);


Route::get('/xxx', [\App\Http\Controllers\UserController::class, "xxx"]);