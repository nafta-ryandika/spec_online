<?php
if ($_SESSION["LOGINAUTH_SPEC_BB"] == "Administrator") {
    include "group/sidebaradmin.php";
}
elseif ($_SESSION["LOGINAUTH_SPEC_BB"] == "Spec") {
	include "group/sidebarspec.php";
}
else{
	include "group/sidebarlain.php";
}
?>