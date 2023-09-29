<style>
    body {
        margin: 0;
        font-family: Arial;
    }
    .topnav {
        overflow: hidden;
        background-color: #E26868;
        font-weight: bold;
    }
    .topnav a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }
    .active {
        background-color: red;
    }
    .topnav .icon {
        display: none;
    }
    .dropdown {
        float: left;
        overflow: hidden;
    }
    .dropdown .dropbtn {
        font-size: 17px;
        border: none;
        outline: none;
        color: white;
        padding: 14px 16px;
        background-color: inherit;
        font-family: inherit;
        margin: 0;
        font-weight: bold;
    }
    .dropbtn:hover {
        
    }
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }
    .dropdown-content a {
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        background-color: white;
    }
    
    .topnav a:hover, .dropdown:hover, .dropbtn {
        background-color: #6EBF8B;
        color: white;
        cursor: pointer;
    }
    .dropdown-content a:hover {
        background-color: #6EBF8B;
        color: white;
    }
    .dropdown .caret {
        width: 0;
        height: 0;
        display: inline-block;
        border: 5px solid transparent;
        border-top-color: white;
        vertical-align: bottom;
    }

    .show {
        display: block;
    }

    @media screen and (max-width: 800px) {
        .topnav a:not(:first-child), .dropdown .dropbtn {
            display: none;
        }
        .topnav a.icon {
            float: right;
            display: block;
        }
        .topnav.responsive { 
            position: relative; 
        }
        .topnav.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }
        .topnav.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
        .topnav.responsive .dropdown {
            float: none;
        }
        .topnav.responsive .dropdown-content {
            position: relative;
        }
        .topnav.responsive .dropdown .dropbtn {
            display: block;
            width: 100%;
            text-align: left;
        }
    }
</style>

<div class="topnav" id="myTopnav">
    <a href="home.php">Home</a>
    <!-- <a href="">About</a> -->
    <!-- <a href="">Contact</a> -->
    <div class="dropdown">
        <button class="dropbtn" id="dropdown1" onclick="dropFunction1()">
            Loan Application
            <i class="caret"></i>
        </button>
        <div class="dropdown-content" id="dropdown-content1">
            <a href="loan-apply.php">Apply Loan</a>
            <a href="loan-application.php">My Applications</a>
        </div>
    </div>
    <div class="dropdown">
        <button class="dropbtn" id="dropdown2" onclick="dropFunction2()">
            Loan Account Inquiry
            <i class="caret"></i>
        </button>
        <div class="dropdown-content" id="dropdown-content2">
            <a href="loan-account-inquiry.php">Apply Account Inquiry</a>
            <a href="loan-account-inquiries.php">Account Inquiries</a>
        </div>
    </div>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>
</div>

<script>
    // main menu show menu on mobile
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if(x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }

    // close dropdown when user clicks outside of it
    window.onclick = function(event) {
        if(!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for(i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if(openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

    // show sub menu
    function dropFunction1() {
        document.getElementById("dropdown-content1").classList.toggle("show");
    }
    function dropFunction2() {
        document.getElementById("dropdown-content2").classList.toggle("show");
    }
    
</script>