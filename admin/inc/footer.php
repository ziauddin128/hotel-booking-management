<?php require "inc/scripts.php"; ?>


<script>
    function activeMenu()
    {
        let nav_bar = document.querySelector("#nav-bar");
        let nav_a_tags = nav_bar.getElementsByTagName("a");
        for (let i = 0; i < nav_a_tags.length; i++) 
        {
            let nav_path = nav_a_tags[i].href.split('/').pop();
            let activePath = document.location.href;

            if(activePath.indexOf(nav_path) >= 0)
            {
            nav_a_tags[i].classList.add("active");
            }    
        }
    }
    activeMenu();
</script>


</body>
</html>