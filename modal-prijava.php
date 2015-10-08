	   <?php
    if(!isset($_SESSION['autoriziran'])){ ?>	
<div class="modal fade" id="autorizacija" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Prijava</h4>
            </div>

		<form action="#" id="login">
            <div class="modal-body">	
                    <fieldset>
    <div>  <label for="email">Email</label> <input type="email" id="email" placeholder="Unesite e-mail" /> </div>
                        
   <div>   <label for="lozinka">Lozinka</label> <input type="password" id="lozinka" placeholder="Unesite lozinku" /> </div>
                    </fieldset>   
                  <p id="poruka"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Odustani</button>
                <button id="prijava" type="button submit" class="btn btn-default" name="prijava">PRIJAVA</button>
                          <?php } ?>
            </div>
        </form>

        </div>
    </div>
</div>
  