<?php

use Illuminate\Database\Seeder;


class CourtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courts')->insert([
            ['location' => 'Dušan Radović, Đerdapska 45', 'city_id' => 1, 'lat' => 43.319638, 'long' => 21.931172, 'description' => 'Osnovna škola Duško Radović nalazi se na Duvaništu. Škola pored sale poseduje i terene napolju. Škola raspolaže terenom za odbojku, teren za tenis, teren za rukomet i mali fudbal i teren za veliki fudbal. Svi tereni imamo tartan podlogu kao i atletska staza oko terena.'],
            ['location' => 'Miroslav Antić, Knjaževačka 156', 'city_id' => 1, 'lat' => 43.328854, 'long' => 21.936165, 'description' => 'Osnovna škola Mika Antić nalazi se na Durlanu. Škola pored sale poseduje i terene napolju. Škola raspolaže jednim betonskim terenom za mali fudbal i rukomet, jednim betonskim terenom za košarku i teren sa veštačkom travom za mali fudbal. Sala je pogodna za sve unutrašnje sportove.'],            
            ['location' => 'Teniski Klub Radnički, Jadranska bb', 'city_id' => 1, 'lat' => 43.326089, 'long' => 21.899027, 'description' => 'Tereni teniskog kluba Radnički iz Niša, nalaze se blizu ulaza u Nišku tvrđavu. Klub raspolaže sa 6 zemljanih terena koji se svakodnevno održavaju. U okviru terena nalazi se i restoran. Za ostale informacije i rezervacije pozvati na broj: +381 (018) 522 740'],   
            ['location' => 'Svetozar Marković, Branka Radičevića 1', 'city_id' => 1, 'lat' => 43.3120531, 'long' => 21.8856456, 'description' => 'Tereni kod gimnazije Svetozar Marković nalaze se na Paliluli. Tereni su i u blizini Fakulteta Sporta i Fakulteta Zaštite Na Radu. Postoje dva betonska terena za Košarku, teren sa veštačkom travom za fudbal i betonski teren za tenis. Takodje gimnazija poseduje i salu za sve unutrašnje sportove.'],
            ['location' => 'SC Čair, 9. Brigade', 'city_id' => 1, 'lat' => 43.3146372, 'long' => 21.9080322, 'description' => 'Sportski Centar Čair nalazi se u neposrednoj blizini centra grada. Ceo kompleks poseduje dvoranu, zatvorene i otvorene bazene, balon salu, fudbalski teren i pomoćni fudbalski teren sa veštačkom travom. U dvorani je moguće održavanje svih unutrašnjih sportova. Preko cele zime balon sala se pretvara u klizalište. Za sve ostale informacije i rezervacije pozvati na broj: +381 (018) 511 979'],
        ]);
    }
}
