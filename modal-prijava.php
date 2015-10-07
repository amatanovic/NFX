
	   <?php
    if(!isset($_SESSION['autoriziran'])){ ?>	
<div class="modal fade in" style="display: block; padding-left: 17px;" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Prijava</h4>
            </div>
				
		<form action="#" id="login">
            <div class="modal-body">
                    <fieldset>
      <label for="email">Email</label> <input type="email" id="email" placeholder="Unesite e-mail" /> 
      <label for="lozinka">Lozinka</label> <input type="password" id="lozinka" placeholder="Unesite lozinku" /> 
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

  