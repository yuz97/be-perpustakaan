<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'title' => 'naruto shippude',
                'description' => 'adalah sebuah serial manga karya Masashi Kishimoto yang diadaptasi menjadi serial anime. Manga Naruto bercerita seputar kehidupan tokoh utamanya, Naruto Uzumaki, seorang ninja yang hiperaktif, periang, dan ambisius yang ingin mewujudkan keinginannya untuk mendapatkan gelar Hokage, pemimpin dan ninja terkuat di desanya. ',
                'image_url' => 'naruto.jpg',
                'release_year' => 2020,
                'price' => '200.000',
                'total_page' => 205,
                'thickness' => 'tebal',
                'category_id' => 6
            ],

            [
                'title' => 'One piece',
                'description' => 'One Piece adalah sebuah seri manga Jepang yang ditulis dan diilustrasikan oleh Eiichiro Oda. Manga ini telah dimuat di majalah Weekly Shōnen Jump milik Shueisha sejak tanggal 22 Juli 1997, dan telah dibundel menjadi 105 volume tankōbon hingga Maret 2023',
                'image_url' => 'onepiece.jpg',
                'release_year' => 2020,
                'price' => '800.000',
                'total_page' => 300,
                'thickness' => 'tebal',
                'category_id' => 2
            ],

        ];

        foreach ($books as $book ) {
            Book::create($book);
        }
    }
}
