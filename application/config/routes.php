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
$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['logout'] = 'auth/logout';
$route['staff-login'] = 'auth/staffLogin';

// User
$route['users'] = 'user/index';

// Bed
$route['bed'] = 'bed/index';
$route['bed/store'] = 'bed/store';
$route['bed/(:num)/update'] = 'bed/update/$1';
$route['bed/(:num)/delete'] = "bed/destroy/$1";

// Cart
$route['cart'] = "cart/show";
$route['cart/store'] = "cart/store";
$route['cart/user/${userId}/room/${roomId}/delete'] = "cart/destroy/$1/$2";

// Facility
$route['facilities'] = 'facility/index';

// Hotel
$route['hotel'] = "hotel/index";
$route['hotel/(:num)/show'] = "hotel/show/$1";

// Room
$route['hotel/(:num)/room/(:num)/delete'] = "room/room/destroy/$1/$2";
$route['room/findAvaiableRooms'] = "room/room/findAvaiableRooms";

// Payment
$route['payments'] = "payment/index";
$route['payments/(:num)/detail'] = "payment/detailPayment/$1";
$route['payments/(:any)/pay-now'] = "payment/payNow/$1";
$route['payments/notif'] = "payment/handleNotification";
$route['test'] = "payment/test";

// Bookings
$route['bookings/add-booking'] = "booking/Booking/addBooking";

// BookingRequest
$route['bookings/requests'] = "booking/BookingRequest/index";
$route['requests/update'] = "booking/BookingRequest/index";

// Schedule
$route['bookings/schedules'] = "schedule/index";

// Order
$route['guest/order'] = "order/listBookings";






























// Hotel Route
$route['hotel/create'] = "hotel/create";
$route['hotel/store'] = "hotel/store";
$route['hotel/(:num)/edit'] = "hotel/edit/$1";
$route['hotel/(:num)/update'] = "hotel/update/$1";
$route['hotel/(:num)/delete'] = "hotel/destroy/$1";

// Room Route
$route['hotel/(:num)/room'] = "room/room/index/$1";
$route['hotel/(:num)/room/create'] = "room/room/create/$1";
$route['hotel/(:num)/room/store'] = "room/room/store/$1";
$route['hotel/(:num)/room/(:num)/edit'] = "room/room/edit/$1/$2";
$route['hotel/(:num)/room/(:num)/update'] = "room/room/update/$1/$2";
$route['hotel/(:num)/room/search'] = "room/room/searchAvailableRooms/$1";

// Room Code Route
$route['hotel/(:num)/room/(:num)/room-code'] = "room/roomcode/index/$1/$2";
$route['hotel/(:num)/room/(:num)/room-code/store'] = "room/roomcode/store/$1/$2";
$route['hotel/(:num)/room/(:num)/room-code/(:num)/update'] = "room/roomcode/update/$1/$2/$3";
$route['hotel/(:num)/room-code/(:num)/update-status'] = "room/roomcode/updateRoomStatus/$1/$2";

// Booking Route
$route['hotel/(:num)/booking/calendar'] = "booking/booking/calendar/$1";
$route['hotel/(:num)/booking/(:num)/show'] = "booking/booking/show/$1/$2";
$route['hotel/(:num)/room/(:num)/booking'] = "booking/booking/create/$1/$2";
$route['hotel/(:num)/room/(:num)/booking/store'] = "booking/booking/store/$1/$2";
$route['hotel/(:num)/room-code/(:num)/booking/(:num)/guest-cancel'] = "booking/booking_cancel/$1/$2/$3"; // update pembatalan reservasi
$route['hotel/(:num)/room-code/(:num)/booking/(:num)/guest-in'] = "booking/check_in/$1/$2/$3"; // update saat tamu masuk
$route['hotel/(:num)/room-code/(:num)/booking/(:num)/guest-out'] = "booking/check_out/$1/$2/$3"; // update saat tamu keluar

// Payment Route
$route['hotel/(:num)/payment'] = "payment/index/$1";
$route['payment/(:num)/reservation/(:num)/process'] = "payment/process/$1/$2";

$route['hotel/(:num)/reservation/(:num)/payment/(:num)/completed'] = "payment/confirm_status_payment/$1/$2/$3";
$route['hotel/(:num)/reservation/(:num)/payment/(:num)/cancelled'] = "payment/cancel_status_payment/$1/$2/$3";
$route['reservation/(:num)/detail'] = "order/detail_order/$1";

// Route untuk set reservation status
$route['hotel/(:num)/booking/(:num)/status'] = "booking/managementBooking/manageStatus/$1/$2";
$route['hotel/(:num)/booking/(:num)/cancelled'] = "booking/managementBooking/cancelBooking/$1/$2";

$route['hotel/(:num)/reservation/(:num)/confirmed'] = "reservationStatus/confirmed/$1/$2";
$route['hotel/(:num)/reservation/(:num)/checked-in'] = "reservationStatus/checked_in/$1/$2";
$route['hotel/(:num)/reservation/(:num)/in-house'] = "reservationStatus/in_house/$1/$2";
$route['hotel/(:num)/reservation/(:num)/checked-out'] = "reservationStatus/checked_out/$1/$2";

$route['guest/hotel/search'] = "hotel/findAvailableHotel";
$route['guest/hotel/set'] = "hotel/setDetailHotel";
$route['guest/hotel/detail'] = "hotel/showDetailHotel";

$route['guest/hotel/(:num)/room'] = "room/room/guest_room/$1";
$route['guest/hotel/(:num)/room/(:num)/booking/(:num)/(:num)'] = "booking/booking/showBooking/$1/$2/$3/$4";
$route['guest/hotel/(:num)/room/(:num)/booking/store'] = "booking/guest_store/$1/$2";
$route['guest/order/(:num)/detail'] = "order/detail_order/$1";
$route['guest/payment/(:num)/transfer'] = "payment/guest_transfer/$1";

$route['booking/multiple'] = "booking/multipleBooking/showBookRooms";
$route['booking/multiple/store'] = "booking/multipleBooking/storeBookRooms";
$route['payment/notification'] = "booking/multipleBooking/handleNotification";
