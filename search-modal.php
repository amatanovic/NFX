<!-- Modal -->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h1 class="modal-title">Pretraživanje</h1>
          <hr />
      </div>
      <div class="modal-body">
          
        <h2>Jednostavno pretraživanje</h2>
          <hr />
          <div>  <label for="tag">Ključne riječi:</label> <input type="text" id="tag" name="uvjet" placeholder="Unesite ključnu riječ" /> </div> 
          
        <h2>Složeno pretraživanje</h2>
          <hr />
          <label for="kategorije">Kategorije:</label>
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
      <div class="modal-footer">
        <button type="button submit" class="btn btn-default" name="search" id="searchStart">SEARCH</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>