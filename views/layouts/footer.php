<style>
.footer-bottom {
    background-color: #181828 !important;
    color: #99a9b5;
    font-family: rubik;
    padding: 15px 0;
    border-top: 1px solid #313646;
    width: 100%;
    margin-top: 50px;
}

.footer-site-info {
    font-size: 92.86%;
    color: #b0b0b0;
}

#footer-navigation {
    text-align: center;
    padding-top: 10px;
}

#footer-menu {
    display: flex;
    justify-content: center;
    gap: 30px; /* spacing between items */
    list-style: none;
    padding: 0;
    margin: 0;
}

#footer-menu li {
    display: inline-block;
}

#footer-menu li a {
    color: #99a9b5;
    font-size: 15px;
    text-decoration: none;
}

#footer-menu li a:hover {
    color: white;
}

#footer-socials {
    text-align: right;
}

#footer-socials .socials {
    margin: 0 -7px;
    display: inline-block;
    vertical-align: middle;
}

a.socials-item {
    display: inline-block;
    text-align: center;
    margin: 0 5px;
    padding: 10px;
    border-radius: 50%;
    background-color: #141421;
    border: 1px solid #2e2e4c;
    box-shadow: 3px 9px 16px rgba(0, 0, 0, 0.4), 
                -3px -3px 10px rgba(255, 255, 255, 0.06),
                inset 14px 14px 26px rgba(0, 0, 0, 0.3), 
                inset -3px -3px 15px rgba(255, 255, 255, 0.05);
    transition: all 0.3s ease;
}

a.socials-item:hover {
    box-shadow: 0 0px 20px rgba(84, 1, 74, 0.7);
    border-color: rgba(255, 6, 224, 0.61);
    background: linear-gradient(to right, rgba(255, 9, 9, 0.13), #c000ffb5, rgba(255, 0, 94, 0.14));
}

.footer-title {
    margin-bottom: 40px;
    color: #fff;
    font-weight: 500;
    text-transform: capitalize;
    padding-bottom: 15px;
    font-size: 16px;
    position: relative;
}

.footer-title:after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 1px;
    background: #fff;
    opacity: 0.2;
}

    
</style>


<footer>
    <div class="footer-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="footer-site-info">2025 © <a href="https://www.youtube.com/watch?v=hbnDk7ogPQ4" target="_blank">Blog on DEV</a></div>
                </div>

                <div class="col-md-6">
                    <nav id="footer-navigation" class="site-navigation footer-navigation centered-box" role="navigation">
                        <ul id="footer-menu" class="nav-menu styled clearfix inline-inside">
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Disclaimer</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-md-3">
                    <div id="footer-socials">
                        <div class="socials inline-inside socials-colored">
                            <a href="#" title="Facebook" class="socials-item"><i class="fab fa-facebook-f facebook"></i></a>
                            <a href="#" title="Instagram" class="socials-item"><i class="fab fa-instagram instagram"></i></a>
                            <a href="#" title="YouTube" class="socials-item"><i class="fab fa-youtube youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
