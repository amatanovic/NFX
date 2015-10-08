<!-- Modal -->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title">Pretraživanje</h1>
          
      </div>
      <div class="modal-body">
          
        <h2 class="pretrazi">JEDNOSTAVNO PRETRAŽIVANJE</h2>
          
        
          <div class="kljucne">  <label for="tag">Ključne riječi:</label> <input type="text" id="tag" name="uvjet" placeholder="Unesite ključnu riječ" /> </div> 
          <br />
       
        <h2 class="pretrazi">SLOŽENO PRETRAŽIVANJE</h2>
          
          <div class="kljucne"><label for="kategorije">Kategorije:</label>
          <?php 
          echo "<select id='uvjetKategorije' name='uvjetKategorije'><option value='' selected='selected'>Sve kategorije</option>";
$izraz = $veza->prepare("select * from kategorija");
          $izraz->execute();
          $entitet1=$izraz->fetchALL(PDO::FETCH_OBJ);
          foreach($entitet1 as $en){
echo "<option value=\"" . $en->sifra . "\">" . $en->naziv ."</option>";

          }
echo "</select>";
?>
</div>
      </div>
      <div class="modal-footer">
        <button type="button submit" class="btn btn-default" name="search" id="searchStart">PRETRAŽI</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
      </div>
    </div>

  </div>
</div>