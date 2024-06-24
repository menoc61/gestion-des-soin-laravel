<?php

use App\Http\Controllers\AppointmentController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/lang/{locale}', 'HomeController@lang');

// Patients
Route::get('/patient/create', 'PatientController@create')->name('patient.create')->middleware(['role_or_permission:Admin|add patient']);
Route::post('/patient/create', 'PatientController@store')->name('patient.store');
Route::get('/patient/all', 'PatientController@all')->name('patient.all')->middleware(['role_or_permission:Admin|view all patients']);
Route::get('/patient/view/{id}', 'PatientController@view')->where('id', '[0-9]+')->name('patient.view')->middleware(['role_or_permission:Admin|view patient']);
Route::get('/patient/edit/{id}', 'PatientController@edit')->where('id', '[0-9]+')->name('patient.edit')->middleware(['role_or_permission:Admin|edit patient']);
Route::post('/patient/edit', 'PatientController@store_edit')->name('patient.store_edit');
Route::get('/patient/delete/{id}', 'PatientController@destroy')->where('id', '[0-9]+')->name('patient.destroy')->middleware(['role_or_permission:Admin|delete patient']);
Route::post('/patient/search', 'PatientController@search')->name('patient.search');
Route::get('/patient/send_password/{id}', 'PatientController@SendPassword')->where('id', '[0-9]+')->name('patient.SendPassword')->middleware(['role_or_permission:Admin|add patient']);

// Documents
Route::get('/document/all', 'DocumentController@all')->name('document.all')->middleware(['role_or_permission:Admin|edit patient']);
Route::post('/document/create', 'DocumentController@store')->name('document.store')->middleware(['role_or_permission:Admin|edit patient']);
Route::get('/document/delete/{id}', 'DocumentController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit patient']);

// Documents
Route::post('/history/create', 'HistoryController@store')->name('history.store')->middleware(['role_or_permission:Admin|edit patient']);
Route::get('/history/delete/{id}', 'HistoryController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit patient']);

// Appointments
Route::get('/appointment/create', 'AppointmentController@create')->name('appointment.create')->middleware(['role_or_permission:Admin|create appointment']);
Route::post('/appointment/create', 'AppointmentController@store')->name('appointment.store');
Route::get('/appointment/all', 'AppointmentController@all')->name('appointment.all')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/calendar', 'AppointmentController@calendar')->name('appointment.calendar')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/pending', 'AppointmentController@pending')->name('appointment.pending')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/checkslots/{id}', 'AppointmentController@checkslots');
Route::get('/appointment/delete/{id}', 'AppointmentController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete appointment']);
Route::post('/appointment/edit', 'AppointmentController@store_edit')->name('appointment.store_edit')->middleware(['role_or_permission:Admin|edit appointment']);
Route::get('/appointment/create_by/{id}', 'AppointmentController@create_By_id')->name('appointment.create_by')->middleware(['role_or_permission:Admin|create appointment']);
Route::get('/appointment/notify/whatsapp/{id}', 'AppointmentController@notify_whatsapp')->name('appointment.notify.whatsapp')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/notify/email/{id}', 'AppointmentController@notify_email')->name('appointment.notify.email')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/get-appointment/{id}', 'AppointmentController@getAppointments')->name('appointment.getappointments');
Route::get('/appointment/upcoming', 'AppointmentController@upcoming')->name('appointment.upcoming')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/cancelled', 'AppointmentController@cancelled')->name('appointment.cancelled')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/treated', 'AppointmentController@treated')->name('appointment.treated')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/today', 'AppointmentController@today')->name('appointment.today')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/notify/whatsapp/{id}', 'AppointmentController@notify_whatsapp')->name('appointment.notify.whatsapp')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/notify/email/{id}', 'AppointmentController@notify_email')->name('appointment.notify.email')->middleware(['role_or_permission:Admin|view all appointments']);
Route::get('/appointment/get-appointment/{id}', 'AppointmentController@getAppointments')->name('appointment.getappointments');
Route::get('/appointments/by-doctor/{doctorId}', 'AppointmentController@getAppointmentsByDoctor');


// Drugs
Route::get('/drug/create', 'DrugController@create')->name('drug.create')->middleware(['role_or_permission:Admin|create drug']);
Route::post('/drug/create', 'DrugController@store')->name('drug.store');
Route::get('/drug/edit/{id}', 'DrugController@edit')->where('id', '[0-9]+')->name('drug.edit')->middleware(['role_or_permission:Admin|edit drug']);
Route::post('/drug/edit', 'DrugController@store_edit')->name('drug.store_edit');
Route::get('/drug/all', 'DrugController@all')->name('drug.all')->middleware(['role_or_permission:Admin|view all drugs']);
Route::get('/drug/delete/{id}', 'DrugController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete drug']);

// Tests
Route::get('/test/create', 'TestController@create')->name('test.create')->middleware(['role_or_permission:Admin|create diagnostic test']);
Route::post('/test/create', 'TestController@store')->name('test.store');
Route::get('/test/edit/{id}', 'TestController@edit')->name('test.edit')->middleware(['role_or_permission:Admin|edit diagnostic test']);
Route::post('/test/edit', 'TestController@store_edit')->name('test.store_edit');
Route::get('/test/all', 'TestController@all')->name('test.all')->middleware(['role_or_permission:Admin|view all diagnostic tests']);
Route::get('/test/delete/{id}', 'TestController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete diagnostic test']);
Route::get('/test/view/{id}', 'TestController@view_test')->where('id', '[0-9]+');
Route::get('/test/user/{id}', 'TestController@view_diagnostic')->where('id', '[0-9]+')->name('test.view_diagnostic')->middleware(['role_or_permission:Admin|view patient']);
Route::get('/test/create_by/{id}', 'TestController@create_By_Id')->where('id', '[0-9]+')->name('test.create_by');
Route::post('/test/create_by/{id}', 'TestController@store')->name('test.store_id');
Route::get('/test/psychotherapi/{id}', 'TestController@create_Psychotherapie_By_Id')->where('id', '[0-9]+')->name('test.psychotherapie');
// Prescriptions
Route::get('/prescription/create', 'PrescriptionController@create')->name('prescription.create')->middleware(['role_or_permission:Admin|create prescription']);
Route::post('/prescription/create', 'PrescriptionController@store')->name('prescription.store');
Route::get('/prescription/all', 'PrescriptionController@all')->name('prescription.all')->middleware(['role_or_permission:Admin|view all prescriptions']);
Route::get('/prescription/view/{id}', 'PrescriptionController@view')->where('id', '[0-9]+')->name('prescription.view')->middleware(['role_or_permission:Admin|view prescription']);
Route::get('/prescription/pdf/{id}', 'PrescriptionController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print prescription']);
Route::get('/prescription/delete/{id}', 'PrescriptionController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete prescription']);
Route::get('/prescription/user/{id}', 'PrescriptionController@view_for_user')->where('id', '[0-9]+')->name('prescription.view_for_user')->middleware(['role_or_permission:Admin|view patient']);
Route::get('prescription/follow/{id}', 'PrescriptionController@follow')->name('prescription.follow')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::get('/prescription/edit/{id}', 'PrescriptionController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit prescription']);
Route::post('/prescription/update', 'PrescriptionController@update')->name('prescription.update');
Route::get('/prescription/create_by/{id}', 'PrescriptionController@create_By_Id')->where('id', '[0-9]+')->name('prescription.create_by');
Route::post('/prescription/create_by/{id}', 'PrescriptionController@store')->name('prescription.store_id');
Route::get('/prescription/praticien/{id}/{user_id}/{doc_id}', 'PrescriptionController@followId')->name('prescription.doctorrdv');
Route::get('/prescription/psychotherapi/{id}', 'PrescriptionController@create_Psychotherapie_By_Id')->where('id', '[0-9]+')->name('prescription.psycho_by');

// Billing
Route::get('/billing/create', 'BillingController@create')->name('billing.create')->middleware(['role_or_permission:Admin|create invoice']);
Route::post('/billing/create', 'BillingController@store')->name('billing.store');
Route::get('/billing/all', 'BillingController@all')->name('billing.all')->middleware(['role_or_permission:Admin|view all invoices']);
Route::get('/billing/view/{id}', 'BillingController@view')->where('id', '[0-9]+')->name('billing.view')->middleware(['role_or_permission:Admin|view invoice']);
Route::get('/billing/pdf/{id}', 'BillingController@pdf')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|print invoice']);
Route::get('/billing/delete/{id}', 'BillingController@destroy')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|delete invoice']);
Route::get('/billing/edit/{id}', 'BillingController@edit')->where('id', '[0-9]+')->middleware(['role_or_permission:Admin|edit invoice']);
Route::post('/billing/update', 'BillingController@update')->name('billing.update');
Route::get('/billing/create_by/{id}', 'BillingController@create_By_Id')->where('id', '[0-9]+')->name('billing.create_by');
Route::post('/billing/create_by/{id}', 'BillingController@store')->name('billing.store_id');
Route::get('/payment/create/{id}', 'BillingController@create_payment')->where('id', '[0-9]+')->name('billing.payment')->middleware(['role_or_permission:Admin|create invoice']);
// Route pour enregistrer le paiement supplémentaire
Route::post('/payment/create/{id}', 'BillingController@storeBilling')->name('payment.store');


// Settings
/* Doctorino Settings */
Route::get('/settings/doctorino_settings', 'SettingController@doctorino_settings')->name('doctorino_settings.edit');
Route::post('/settings/doctorino_settings', 'SettingController@doctorino_settings_store')->name('doctorino_settings.store');
/* Prescription Settings */
Route::get('/settings/prescription_settings', 'SettingController@prescription_settings')->name('prescription_settings.edit');
Route::post('/settings/prescription_settings', 'SettingController@prescription_settings_store')->name('prescription_settings.store');

/* Notification setting Settings */
Route::get('/settings/notifications_settings', 'SettingController@notifications_settings')->name('notifications_settings');
Route::post('/settings/notifications_settings', 'SettingController@notifications_settings_store')->name('notifications_settings.store');

/* Users */
Route::get('/users/all', 'UsersController@all')->name('user.all');
Route::get('/users/create', 'UsersController@create')->name('user.create');
Route::post('/users/create', 'UsersController@store')->name('user.store');
Route::get('/users/edit/{id}', 'UsersController@edit')->where('id', '[0-9]+')->name('user.edit');
// Route::get('/users/edit', 'UsersController@edit_profile')->name('user.edit_profile');
Route::post('/users/edit', 'UsersController@store_edit')->name('user.store_edit');
Route::post('/users/fonction/search', 'UsersController@searchfonction')->name('user.search');
/* Roles */
Route::get('/roles/all', 'RolesController@all_roles')->name('roles.all')->middleware(['role_or_permission:Admin']);
Route::get('/role/create', 'RolesController@create')->name('role.create')->middleware(['role_or_permission:Admin']);
Route::post('/role/create', 'RolesController@store')->name('role.store');
Route::get('/role/edit/{id}', 'RolesController@edit_role')->where('id', '[0-9]+')->name('role.edit_role')->middleware(['role_or_permission:Admin']);
Route::post('/role/edit', 'RolesController@store_edit_role')->name('role.store_edit_role');
Route::get('/role/delete/{id}', 'RolesController@destroy')->where('id', '[0-9]+')->name('role.destroy')->middleware(['role_or_permission:Admin']);

/* [process csv] */
Route::post('/process-csv', 'CsvController@processCsv')->name('process.csv');
Route::get('/display-products', 'CsvController@displayProducts')->name('display.products');

Route::post('/envoyer-notification', 'MailInvoiceController@envoyerNotificationAll')->name('envoyer.MailInvoiceNotificationAll');

/* Waiting room */
Route::get('/waiting_room/view', 'WaitingroomController@view')->name('wr.view')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::get('/waiting_room/archive', 'WaitingroomController@archive')->name('wr.archive')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::get('/waiting_room/ongoing/{id}', 'WaitingroomController@update_to_ongoing')->where('id', '[0-9]+')->name('wr.update.ongoing')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::get('/waiting_room/archive/{id}', 'WaitingroomController@update_to_archive')->where('id', '[0-9]+')->name('wr.update.archive')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::get('/waiting_room/delete/{id}', 'WaitingroomController@delete')->where('id', '[0-9]+')->name('wr.delete')->middleware(['role_or_permission:Admin|manage waiting room']);

Route::get('/waiting_room/archive/all', 'WaitingroomController@view_archive')->name('wr.archive.all')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::post('/waiting_room/create', 'WaitingroomController@store')->name('wr.store')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::post('/waiting_room/search', 'WaitingroomController@search')->name('wr.search')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::post('/waiting_room/search_in_archive', 'WaitingroomController@search_in_archive')->name('wr.search_in_archive')->middleware(['role_or_permission:Admin|manage waiting room']);
Route::post('/waiting_room/filter', 'WaitingroomController@filter')->name('wr.filter')->middleware(['role_or_permission:Admin|manage waiting room']);

// Notifications
Route::get('/notification/create', 'NotificationController@create')->name('notification.create')->middleware(['role_or_permission:Admin|view notification']);
Route::post('/notification/create', 'NotificationController@store')->name('notification.store');
Route::get('/notification/edit/{id}', 'NotificationController@edit')->where('id', '[0-9]+')->name('notification.edit')->middleware(['role_or_permission:Admin|edit notification']);
Route::post('/notification/edit', 'NotificationController@store_edit')->name('notification.store_edit');
Route::get('/notification/all', 'NotificationController@all')->name('notification.all')->middleware(['role_or_permission:Admin|view all notification']);
Route::get('/notification/delete/{id}', 'NotificationController@destroy')->where('id', '[0-9]+')->name('notification.delete')->middleware(['role_or_permission:Admin|delete notification']);
Route::post('/notification/delete-selected', 'NotificationController@deleteSelected')->name('notification.delete-selected')->middleware(['role_or_permission:Admin|delete notification']);


