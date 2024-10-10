<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = $this->getBooks();

        foreach ($books as $book) {
            \App\Models\Book::factory()->create($book);
        }
    }

    /**
     * Get the books to seed.
     *
     * @return array The books to seed.
     */
    private function getBooks(): array
    {
        return [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'The story of the mysteriously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'published_at' => '1925-04-10',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'The story of a young girl confronting deep-seated racial prejudice in the American South.',
                'published_at' => '1960-07-11',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian novel that delves into the dangers of totalitarianism and extreme political ideology.',
                'published_at' => '1949-06-08',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'The romantic clash between Elizabeth Bennet and the wealthy Mr. Darcy.',
                'published_at' => '1813-01-28',
            ],
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'description' => 'A young boy’s journey through teenage rebellion and confusion in 1950s New York.',
                'published_at' => '1951-07-16',
            ],
            [
                'title' => 'Moby-Dick',
                'author' => 'Herman Melville',
                'description' => 'Captain Ahab’s obsessive quest to kill the white whale, Moby Dick.',
                'published_at' => '1851-10-18',
            ],
            [
                'title' => 'War and Peace',
                'author' => 'Leo Tolstoy',
                'description' => 'A historical epic that chronicles the French invasion of Russia and its effects on five aristocratic families.',
                'published_at' => '1869-01-01',
            ],
            [
                'title' => 'The Odyssey',
                'author' => 'Homer',
                'description' => 'The epic tale of Odysseus’ journey home after the fall of Troy.',
                'published_at' => '1800-01-01',
            ],
            [
                'title' => 'Brave New World',
                'author' => 'Aldous Huxley',
                'description' => 'A dystopian vision of a future where society is engineered for efficiency and stability.',
                'published_at' => '1932-08-01',
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'The story of Bilbo Baggins, a hobbit who embarks on an unexpected adventure.',
                'published_at' => '1937-09-21',
            ],
            [
                'title' => 'Crime and Punishment',
                'author' => 'Fyodor Dostoevsky',
                'description' => 'The psychological drama of a man’s guilt and redemption after committing a murder.',
                'published_at' => '1866-01-01',
            ],
            [
                'title' => 'The Divine Comedy',
                'author' => 'Dante Alighieri',
                'description' => 'An epic poem depicting Dante’s journey through Hell, Purgatory, and Heaven.',
                'published_at' => '1320-01-01',
            ],
            [
                'title' => 'The Brothers Karamazov',
                'author' => 'Fyodor Dostoevsky',
                'description' => 'A philosophical novel about faith, doubt, and morality centered around a patricide.',
                'published_at' => '1880-01-01',
            ],
            [
                'title' => 'The Iliad',
                'author' => 'Homer',
                'description' => 'The epic story of the Trojan War and the heroism of Achilles.',
                'published_at' => '1750-01-01',
            ],
            [
                'title' => 'The Lord of the Rings: The Fellowship of the Ring',
                'author' => 'J.R.R. Tolkien',
                'description' => 'The first part of the epic fantasy series about the quest to destroy the One Ring.',
                'published_at' => '1954-07-29',
            ],
            [
                'title' => 'Frankenstein',
                'author' => 'Mary Shelley',
                'description' => 'The chilling tale of a scientist who creates life and faces the monstrous consequences.',
                'published_at' => '1818-01-01',
            ],
            [
                'title' => 'The Adventures of Huckleberry Finn',
                'author' => 'Mark Twain',
                'description' => 'A young boy and a runaway slave journey down the Mississippi River.',
                'published_at' => '1884-12-10',
            ],
            [
                'title' => 'Jane Eyre',
                'author' => 'Charlotte Brontë',
                'description' => 'The story of an orphaned girl’s growth and her love for the mysterious Mr. Rochester.',
                'published_at' => '1847-10-16',
            ],
            [
                'title' => 'Wuthering Heights',
                'author' => 'Emily Brontë',
                'description' => 'A tale of intense, destructive love set on the Yorkshire moors.',
                'published_at' => '1847-12-01',
            ],
            [
                'title' => 'Anna Karenina',
                'author' => 'Leo Tolstoy',
                'description' => 'A tragic romance about a woman’s doomed affair with a nobleman in 19th-century Russia.',
                'published_at' => '1878-01-01',
            ],
            [
                'title' => 'Les Misérables',
                'author' => 'Victor Hugo',
                'description' => 'A sweeping historical novel set in post-revolutionary France that examines justice, love, and redemption.',
                'published_at' => '1862-01-01',
            ],
        ];
    }
}
