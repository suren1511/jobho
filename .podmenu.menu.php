<?
global $USER;
if($USER->IsAdmin()) {
	$aMenuLinks = Array(
	Array(
		"Общежития Москвы", 
		"/hostel_in_msc/",
		Array(),
		Array(), 
		"" 
	),
	Array(
		"Общежития Подмосковья", 
		"/dormitory_suburbs/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Общежития Санкт-Петербурга", 
		"/hostel_in_spb/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Общежития на карте", 
		"/obshejitiya_na_karte.php", 
		Array(), 
		Array(), 
		"" 
	), 
	Array(
		"Хостелы Москвы", 
		"/hostels_in_msc/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Хостелы Подмосковья", 
		"/hostels_podmsc/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Хостелы Санкт-Петербурга", 
		"/hostels_in_spb/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Хостелы на карте", 
		"/hostels_na_karte.php", 
		Array(), 
		Array(), 
		"" 
	),
	// Array(
	// 	"Семейные общежития", 
	// 	"/hostel_family/", 
	// 	Array(), 
	// 	Array(), 
	// 	"" 
	// )
);
} else {
	$aMenuLinks = Array(
	Array(
		"Общежития Москвы", 
		"/hostel_in_msc/",
		Array(),
		Array(), 
		"" 
	),
	Array(
		"Общежития Подмосковья", 
		"/dormitory_suburbs/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Общежития Санкт-Петербурга", 
		"/hostel_in_spb/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Общежития на карте", 
		"/obshejitiya_na_karte.php", 
		Array(), 
		Array(), 
		"" 
	), 
	Array(
		"Хостелы Москвы", 
		"/hostels_in_msc/", 
		Array(), 
		Array(), 
		"" 
	),	
	Array(
		"Хостелы на карте", 
		"/hostels_na_karte.php", 
		Array(), 
		Array(), 
		"" 
	),
	// Array(
	// 	"Семейные общежития", 
	// 	"/hostel_family/", 
	// 	Array(), 
	// 	Array(), 
	// 	"" 
	// )
);
}

?>