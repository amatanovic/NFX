   <?php if(!isset($_SESSION['autoriziran'])){ ?>  

<div class="modal fade" id="autorizacija" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Prijava</h4>
            </div>


  <form action="#">
    <fieldset>
        <div class="modal-body">
      <label for="email">Email</label> <input type="email" id="emailPrijava" /> <br />
      <label for="lozinka">Lozinka</label> <input type="password" id="passwordPrijava" /> <br />
        </div>
    </fieldset>
    </form>
        
        <div class="modal-footer">
      <a id="prijavi" href="#" style="width: 100%" type="submit">Prijava</a>
        </div>
  <p id="prijaviPoruka"></p>  
  <?php } ?>    
