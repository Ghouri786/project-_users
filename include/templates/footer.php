<?php
    if ($current_page === "admin") {
        echo '<script src="include/assests/js/admin.js"></script>';
    }  else if ($current_page === "member") {
        echo '<script src="include/assests/js/member.js"></script>';
    }else{
        echo '<script src="include/assests/js/script.js"></script>';
    }
    ?>



</body>
</html>