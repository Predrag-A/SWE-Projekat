@auth
<div id="requestmodal" class="modal">
  <form action="{{ route('request') }}" method="post">
    {{csrf_field()}}
    <div class="modal-content">
      <blockquote class="blue-grey-text text-lighten-2">
        <b>Napomena:</b><br>
        Poruka koju ovde unesete biće prosleđena administratorima. Odgovor možete očekivati u roku od 2-3 dana.
      </blockquote>
      <!-- NASLOV -->
      <div class="input-field">
      <i class="material-icons prefix">border_color</i><input id="request_title" type="text" class="char-counter" name="request_title" data-length="25">
        <label for="request_title">Naslov</label>
      </div>
  
      <!-- SADRZAJ -->
      <div class="input-field">
      <i class="material-icons prefix">create</i><textarea id="request" class="materialize-textarea char-counter" name="request" data-length="255"></textarea>
        <label for="request">Poruka</label>          
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Nazad</a>
      <input type="submit" class="modal-close waves-effect waves-green btn-flat" value="Pošalji">
    </div>
  </form>
</div>
@endauth