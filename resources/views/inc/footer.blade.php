<footer class="page-footer">
  <div class="container">
    <div class="row center">
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light aberdeen" data-position="top" data-tooltip="FAQ" href="{{route('faq')}}"><i class="fas fa-question"></i></a>
        &nbsp;
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light aberdeen" data-position="top" data-tooltip="O nama" href="{{route('about')}}"><i class="fas fa-info"></i></a>
        &nbsp;
        @auth
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light modal-trigger" data-position="top" data-tooltip="Kontakt" href="#requestmodal"><i class="material-icons">email</i></a>
        &nbsp;        
        @endauth
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light aberdeen" data-position="top" data-tooltip="Facebook" href="https://www.facebook.com/Iza%C4%91i-Na-Teren-480017635764875/"><i class="fab fa-facebook-f"></i></a>
        &nbsp;
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light aberdeen" data-position="top" data-tooltip="Twitter" href="https://twitter.com/i_teren"><i class="fab fa-twitter"></i></a>
        &nbsp;
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light aberdeen" data-position="top" data-tooltip="Instagram" href="https://www.instagram.com/izadji_na_teren/"><i class="fab fa-instagram"></i></a>
        &nbsp;
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light aberdeen" data-position="top" data-tooltip="GitHub" href="https://goo.gl/Rp3Qx8"><i class="fab fa-github"></i></a>
        &nbsp;
        <a class="btn-floating btn-medium tooltipped waves-effect waves-light aberdeen" data-position="top" data-tooltip="BitBucket" href="https://goo.gl/DWp5eh"><i class="fab fa-bitbucket"></i></a>      
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      <div class="left">
        #IzađiNaTeren
      </div>
      <div class="right">Copyright &copy; <?php echo date("Y"); ?>, Garbage Collectors</div>
    </div>    
    </div>
</footer>
