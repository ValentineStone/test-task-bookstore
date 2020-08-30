<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $bookdata) {
            $book = App\Book::firstOrCreate([
                'title' => $bookdata[0],
                'price' => $bookdata[1]
            ]);
            $book->authors()->attach(array_map(
                function($author_name) {
                    return App\Author::firstOrCreate(['name' => $author_name])->id;
                },
                array_slice($bookdata, 2)
            ));
        }
    }

    public $data = [
        ['On the Origin of Species: The Illustrated Edition', 19.49, 'Charles Darwin', 'David Quammen'],
        ['On the Origin of Species', 17.04, 'Charles Darwin', 'David Williams'],
        ['The Origin of Species (100 Copy Collector\'s Edition)', 59.95, 'Charles Darwin'],
        ['Cases and Materials on Federal Indian Law (American Casebook Series) 7th Edition', 243.00, 'David Getches', 'Charles Wilkinson', 'Robert Williams', 'Matthew Fletcher', 'Kristen Carpenter'],
        ['God Is Not Great: How Religion Poisons Everything', 53.77, 'Christopher Hitchens'],
        ['Letters to a Young Contrarian', 11.62, 'Christopher Hitchens'],
        ['Arguably: Essays by Christopher Hitchens', 49.48, 'Christopher Hitchens'],
        ['Mortality', 21.97, 'Christopher Hitchens'],
        ['Thomas Jefferson: Author of America (Eminent Lives)', 25.00, 'Christopher Hitchens'],
        ['Hitch-22: A Memoir', 17.99, 'Christopher Hitchens'],
        ['Antifa: The Anti-Fascist Handbook', 12.00, 'Mark Bray'],
        ['Small Is Beautiful: Economics as if People Mattered', 33.35, 'E. F. Schumacher'],
        ['Small Is Beautiful: A Study of Economics as if People Mattered (Vintage classics)', 103.58, 'E. F. Schumacher', 'Jonathan Porritt'],
        ['You Don\'t Know JS: Up & Going 1st Edition', 69.99, 'Kyle Simpson'],
        ['You Don\'t Know JS: this & Object Prototypes 1st Edition', 38.00, 'Kyle Simpson'],
        ['You Don\'t Know JS: Async & Performance 1st Edition', 21.50, 'Kyle Simpson'],
        ['You Don\'t Know JS: ES6 & Beyond 1st Edition', 31.72, 'Kyle Simpson'],
        ['You Don\'t Know JS: Types & Grammar 1st Edition', 46.40, 'Kyle Simpson'],
        ['You Don\'t Know JS: Scope & Closures 1st Edition', 59.65, 'Kyle Simpson'],
        ['A History of Western Philosophy', 27.00, 'Bertrand Russell'],
        ['In Praise of Idleness: And Other Essays (Routledge Classics)', 25.95, 'Bertrand Russell'],
        ['The Bible', 420.69],
        ['Book of Kells', 399.99],
        ['The Rigveda', 50.00],
        ['The Yajurveda', 50.00],
        ['The Samaveda', 50.00],
        ['The Atharvaveda', 50.00],
        ['Tripiṭaka', 300.00],
        ['Déclaration des droits de l\'homme et du citoyen de 1789', 11.95],
        ['Война и мир (в 4-x тoмax, тoмa 1 и 2)', 18.99, 'Лев Николаевич Толстой'],
        ['Война и мир (в 4-x тoмax, тoмa 3 и 4)', 25.00, 'Лев Николаевич Толстой'],
        ['Das Kapital. Kritik der politischen Ökonomie', 21.95, 'Karl Marx']
    ];
}
