<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'hotel/guest_home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Hotel Route
$route['hotel/'] = "hotel/index";
$route['hotel/(:num)/show'] = "hotel/show/$1";
$route['hotel/create'] = "hotel/create";
$route['hotel/store'] = "hotel/store";
$route['hotel/(:num)/edit'] = "hotel/edit/$1";
$route['hotel/(:num)/update'] = "hotel/update/$1";
$route['hotel/(:num)/delete'] = "hotel/destroy/$1";

// Room Route
$route['hotel/(:num)/room'] = "room/index/$1";
$route['hotel/(:num)/room/create'] = "room/create/$1";
$route['hotel/(:num)/room/store'] = "room/store/$1";
$route['hotel/(:num)/room/(:num)/edit'] = "room/edit/$1/$2";
$route['hotel/(:num)/room/(:num)/update'] = "room/update/$1/$2";
$route['hotel/(:num)/room/search'] = "room/search_room_available/$1";
$route['guest/hotel/(:num)/room'] = "room/guest_room/$1";

// Room Code Route
$route['hotel/(:num)/room/(:num)/room-code'] = "roomcode/index/$1/$2";
$route['hotel/(:num)/room/(:num)/room-code/store'] = "roomcode/store/$1/$2";
$route['hotel/(:num)/room/(:num)/room-code/(:num)/update'] = "roomcode/update/$1/$2/$3";
$route['hotel/(:num)/room/(:num)/room-code/(:num)/delete'] = "roomcode/destroy/$1/$2/$3";
$route['hotel/(:num)/room-code/(:num)/update-status'] = "roomcode/update_room_code_status/$1/$2";

// Reservation Route
$route['hotel/(:num)/reservation/calendar'] = "reservation/calendar/$1";
$route['hotel/(:num)/reservation/(:num)/show'] = "reservation/show/$1/$2";
$route['hotel/(:num)/room/(:num)/reservation'] = "reservation/create/$1/$2";
$route['hotel/(:num)/room/(:num)/reservation/store'] = "reservation/store/$1/$2";
$route['hotel/(:num)/room-code/(:num)/reservation/(:num)/guest-cancel'] = "reservation/reservation_cancel/$1/$2/$3"; // update pembatalan reservasi
$route['hotel/(:num)/room-code/(:num)/reservation/(:num)/guest-in'] = "reservation/check_in/$1/$2/$3"; // update saat tamu masuk
$route['hotel/(:num)/room-code/(:num)/reservation/(:num)/guest-out'] = "reservation/check_out/$1/$2/$3"; // update saat tamu keluar
$route['guest/hotel/(:num)/room/(:num)/reservation'] = "reservation/guest_reservation/$1/$2";
$route['guest/hotel/(:num)/room/(:num)/reservation/store'] = "reservation/guest_store/$1/$2";

// Payment Route
$route['hotel/(:num)/payment'] = "payment/index/$1";
$route['payment/(:num)/reservation/(:num)/cancel'] = "payment/cancel/$1/$2";

$route['hotel/(:num)/reservation/(:num)/payment/(:num)/completed'] = "payment/confirm_status_payment/$1/$2/$3";
$route['hotel/(:num)/reservation/(:num)/payment/(:num)/cancelled'] = "payment/cancel_status_payment/$1/$2/$3";
$route['reservation/(:num)/detail'] = "order/detail_order/$1";

// Invoice
$route['reservation/(:num)/invoice'] = "invoice/generate_invoice/$1";

// Route untuk set reservation status
$route['hotel/(:num)/reservation/(:num)/confirmed'] = "reservationstatus/confirmed/$1/$2";
$route['hotel/(:num)/reservation/(:num)/cancelled'] = "reservationstatus/cancelled/$1/$2";
$route['hotel/(:num)/reservation/(:num)/checked-in'] = "reservationstatus/checked_in/$1/$2";
$route['hotel/(:num)/reservation/(:num)/in-house'] = "reservationstatus/in_house/$1/$2";
$route['hotel/(:num)/reservation/(:num)/checked-out'] = "reservationstatus/checked_out/$1/$2";

$route['guest'] = "hotel/guest_home";
$route['guest/order'] = "order/list_order";
$route['guest/order/(:num)/detail'] = "order/detail_order/$1";
$route['guest/payment/(:num)/transfer'] = "payment/guest_transfer/$1";
$route['guest/cart/room/(:num)/add'] = "guest/add_cart/$1";
$route['guest/cart'] = "guest/cart";
