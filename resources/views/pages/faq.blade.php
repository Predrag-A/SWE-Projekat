@extends('layouts.app')
@section('content')

<div class="container">
  <h1>FAQ</h1>
  <blockquote class="blue-grey-text text-lighten-2">
      Ovo su najčešće postavljena pitanja. Ako imate dodatnih pitanja slobodno nas kontaktirajte.
  </blockquote>
  <ul class="collapsible">
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Da li je registracija besplatna?</div>
      <div class="collapsible-body"><span>Da, registracija je skroz besplatna!</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Da li su podaci koje dajem sigurni?</div>
      <div class="collapsible-body"><span>Samo ime, prezime, grad i slika biće vidljivi drugim korisnicima, dok su ostali podaci koje ste uneli prilikom registracije biti zaštićeni.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Kako se kreira događaj?</div>
      <div class="collapsible-body"><span>Događaj kreirate tako što se na glavnoj strani u desnom donjem uglu nalazi pulsirajuće dugme koje kada se pritisne otvara poseban prozor gde unosite informacije o događaju i gde možete da označite ako želite da obavestite vaše prijatelje da ste kreirali novi događaj.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Imam predlog za dodavanje novog terena kome mogu da pošaljem predlog?</div>
      <div class="collapsible-body"><span>Predloge za dodavanje novog grada ili novog terena šalje se isključivo preko kontakt forme koja se može otvoriti pritiskom na dugme u footer-u "Kontakt". Kada se otvori novi prozor tu navedete naslov i tekst poruke. Sve poruke idu administratorima koji će ih pregledati i ako su validne odobriti i ubaciti na sajt.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Zašto ne mogu da napravim novi događaj?</div>
      <div class="collapsible-body"><span>Razlog je to što je vaš nalog suspendovan. Korisnik postaje suspendovan kada prekrši neka pravila korišćenja aplikacije ili ukoliko administratori zaključe da je prekršio neka druga pravila.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Kako mogu da vidim sve događaje na terenu?</div>
      <div class="collapsible-body"><span>Na glavnoj stranici nalazi se mapa sa pinovima u svakom podržanom gradu. Pritiskom na pin od nekog grada prikazuju vam se svi podržani tereni u tom gradu. Ako samo pređete mišem preko pina od terena videćete naziv tog terena i adresu, a klikom na pin otvara se ispod mape deo gde se prikazuju svi događaji na tom terenu sa informacijama za koliko počinje događaj i koliko je pridruženih korisnika, a klikom na "Detalji" otvara vam se posebna strana sa svim dodatnim informacijama o događaju.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Koliko prijatelja mogu da dodam?</div>
      <div class="collapsible-body"><span>Nema ograničenja prilikom dodavanja prijatelja. Što više prijatelja to bolje :)</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Kako mogu da se pridružim događaju?</div>
      <div class="collapsible-body"><span>Nakon što ste izabrali događaj sa glavne strane kojem želite da se pridružite otvoriće vam se nova strana sa svim dodatnim detaljima o tom događaju. Na toj strani postoji dugme "Pridruži se" i pritiskom na njega se pridružujete događaju.</span></div>
    </li>
    <li>
      <div class="collapsible-header"><i class="fas fa-question prefix"></i>Kako mogu da promenim šifru?</div>
      <div class="collapsible-body"><span>Šifra se menja u delu za izmene na vašem profilu. Takođe pored šifre može te da menjate i ime i prezime kao i grad.</span></div>
    </li>
  </ul>
</div>

@endsection