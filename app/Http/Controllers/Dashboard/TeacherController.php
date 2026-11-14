<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    public function teacherPortal()
    {
        try {
            return view('dashboard.teachers.index');
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Teacher Portal View Failed:" . $th->getMessage());
            return redirect()->route('choose-portal')->with('error', "Something went wrong! Please try again later");
        }
    }

    public function teacherAnswerKit(?string $subject = null, ?string $class = null)
    {
        $subjects = $this->answerCatalog();

        if ($subject !== null && !isset($subjects[$subject])) {
            abort(404);
        }

        if ($class !== null && !isset($subjects[$subject]['classes'][$class])) {
            abort(404);
        }

        try {
            if ($subject === null) {
                return view('dashboard.teachers.answer-kit', compact('subjects'));
            }

            $selectedSubject = $subjects[$subject];

            if ($class === null) {
                return view('dashboard.teachers.answer-kit', compact('subjects', 'selectedSubject'));
            }

            $selectedClass = $selectedSubject['classes'][$class];

            return view('dashboard.teachers.answer-kit', compact(
                'subjects',
                'selectedSubject',
                'selectedClass'
            ));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Teacher Answer kit View Failed:" . $th->getMessage());
            return redirect()->route('choose-portal')->with('error', "Something went wrong! Please try again later");
        }
    }

    private function answerCatalog(): array
    {
        $book = static fn (string $title, string $url, ?string $image, string $pages): array => [
            'title' => $title,
            'url' => $url,
            'image' => $image,
            'pages' => $pages,
        ];

        $subjects = [
            'mathematics' => [
                'name' => 'Mathematics',
                'description' => 'Math Stars answer keys for Classes 3 to 5.',
                'icon' => 'fa-calculator',
                'classes' => [],
            ],
            'computer' => [
                'name' => 'Computer / Digital Discovery',
                'description' => 'Digital Discovery answer keys for Classes 1 to 8.',
                'icon' => 'fa-computer',
                'classes' => [],
            ],
        ];

        foreach ([3 => 8, 4 => 10, 5 => 11] as $grade => $pages) {
            $subjects['mathematics']['classes']["class-{$grade}"] = [
                'name' => "Class {$grade}",
                'books' => [
                    $book(
                        "Math Stars {$grade} Answer Key",
                        "assets/ebooks/answer-keys/Maths-Star-{$grade}-answer-key",
                        "assets/images/books/mathstar-grade-{$grade}.jpg",
                        (string) $pages
                    ),
                ],
            ];
        }

        foreach (range(1, 8) as $grade) {
            $subjects['computer']['classes']["class-{$grade}"] = [
                'name' => "Class {$grade}",
                'books' => [
                    $book(
                        "Digital Discovery {$grade} Answer Key",
                        "assets/ebooks/answer-keys/computer/Grade-{$grade}",
                        null,
                        (string) [
                            16, 17, 19, 19, 18, 21, 24, 25,
                        ][$grade - 1]
                    ),
                ],
            ];
        }

        return $subjects;
    }

    public function teacherResourceKit(?string $subject = null, ?string $class = null)
    {
        $subjects = $this->resourceCatalog();

        if ($subject !== null && !isset($subjects[$subject])) {
            abort(404);
        }

        if ($class !== null && !isset($subjects[$subject]['classes'][$class])) {
            abort(404);
        }

        try {
            if ($subject === null) {
                return view('dashboard.teachers.resource-kit', compact('subjects'));
            }

            $selectedSubject = $subjects[$subject];

            if ($class === null) {
                return view('dashboard.teachers.resource-kit', compact('subjects', 'selectedSubject'));
            }

            $selectedClass = $selectedSubject['classes'][$class];

            return view('dashboard.teachers.resource-kit', compact(
                'subjects',
                'selectedSubject',
                'selectedClass'
            ));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Teacher Resource kit View Failed:" . $th->getMessage());
            return redirect()->route('choose-portal')->with('error', "Something went wrong! Please try again later");
        }
    }

    private function resourceCatalog(): array
    {
        $book = static fn (string $title, string $url, ?string $image, ?string $pages, string $badge = ''): array => [
            'title' => $title,
            'url' => $url,
            'image' => $image,
            'pages' => $pages,
            'badge' => $badge,
        ];

        $class = static fn (string $name, array $books): array => [
            'name' => $name,
            'books' => $books,
        ];

        $subjects = [
            'english' => [
                'name' => 'English / Phonics',
                'description' => 'Teaching guides for English and phonics.',
                'icon' => 'fa-language',
                'classes' => [
                    'junior-infant' => $class('Junior Infant', [$book('MBS Jr. Infant Teaching Guide', 'assets/ebooks/english/MBS-Jr-Infant-Teaching-Guides', 'assets/images/books/mbs-1.jpg', '57')]),
                    'senior-infant' => $class('Senior Infant', [$book('MBS Sr. Infant Teaching Guide', 'assets/ebooks/english/MBS-Sr-Infant-Teaching-Guides', 'assets/images/books/mbs-2.jpg', '94')]),
                    'rhymes' => $class('My Book of Rhymes', [$book('My Book of Rhymes Teaching Guide', 'assets/ebooks/english/My-book-of-Rhymes', 'assets/images/books/mbs-3.jpg', '48')]),
                ],
            ],
            'mathematics' => [
                'name' => 'Mathematics',
                'description' => 'Maths teaching guides from infant classes to Class 8.',
                'icon' => 'fa-calculator',
                'classes' => [
                    'junior-infant' => $class('Junior Infant', [
                        $book('Maths Jr. Infant Part 1 TG', 'assets/ebooks/math/Maths-Junior-Infant-Part-1-TG/index.html', 'assets/images/books/math-jr-1.jpg', '98'),
                        $book('Maths Jr. Infant Part 2 TG', 'assets/ebooks/math/Maths-Junior-Infant-Part-2-TG/index.html', 'assets/images/books/math-jr-2.jpg', '88'),
                    ]),
                    'senior-infant' => $class('Senior Infant', [
                        $book('Maths Sr. Infant Part 1 TG', 'assets/ebooks/math/Maths-Senior-Infant-Part-1-TG/index.html', 'assets/images/books/math-sr-1.jpg', '77'),
                        $book('Maths Sr. Infant Part 2 TG', 'assets/ebooks/math/Maths-Senior-Infant-Part-2-TG/index.html', 'assets/images/books/math-sr-2.jpg', '91'),
                    ]),
                ],
            ],
            'general-knowledge' => [
                'name' => 'General Knowledge',
                'description' => 'Small World teaching guides and SNC resources.',
                'icon' => 'fa-globe',
                'classes' => [
                    'junior-infant' => $class('Junior Infant', [$book('Small World Junior TG', 'assets/ebooks/gk/Small-World-Junior-TG', 'assets/images/books/small-world-jr.jpg', '71')]),
                    'senior-infant' => $class('Senior Infant', [$book('Small World Senior TG', 'assets/ebooks/gk/Small-World-Senior-TG', 'assets/images/books/small-world-sr.jpg', '147')]),
                    'class-1' => $class('Class 1', [
                        $book('Small World Class 1', 'assets/ebooks/gk/Small-World-Class-1', 'assets/images/books/small-world-class-1.jpg', '147'),
                        $book('Small World SNC Class 1', 'assets/ebooks/gk/Small-World-SNC-Class-1', 'assets/images/books/small-world-snc-class-1.jpg', '55'),
                    ]),
                    'class-2' => $class('Class 2', [
                        $book('Small World Class 2', 'assets/ebooks/gk/Small-World-Class-2', 'assets/images/books/small-world-class-2.jpg', '188'),
                        $book('Small World SNC Class 2', 'assets/ebooks/gk/Small-World-SNC-Class-2', 'assets/images/books/small-world-snc-class-2.jpg', '45'),
                    ]),
                    'class-3' => $class('Class 3', [
                        $book('Small World Class 3', 'assets/ebooks/gk/Small-World-Class-3', 'assets/images/books/small-world-class-3.jpg', '214'),
                        $book('Small World SNC Class 3', 'assets/ebooks/gk/Small-World-SNC-Class-3', 'assets/images/books/small-world-snc-class-3.jpg', '40'),
                    ]),
                ],
            ],
            'social-studies' => [
                'name' => 'Social Studies',
                'description' => 'Small World SNC teaching guides for Classes 4 and 5.',
                'icon' => 'fa-users',
                'classes' => [
                    'class-4' => $class('Class 4', [$book('Small World SNC Class 4', 'assets/ebooks/gk/Small-World-SNC-Class-4', 'assets/images/books/small-world-snc-class-4.jpg', '78')]),
                    'class-5' => $class('Class 5', [$book('Small World SNC Class 5', 'assets/ebooks/gk/Small-World-SNC-Class-5', 'assets/images/books/small-world-snc-class-5.jpg', '68')]),
                ],
            ],
            'urdu' => [
                'name' => 'Urdu',
                'description' => 'Samar e Urdu teaching guides for every level.',
                'icon' => 'fa-book-open',
                'classes' => [
                    'playgroup' => $class('PlayGroup', [$book('Samar e Urdu Shahtoot PlayGroup TG', 'assets/ebooks/urdu/Samar-e-Urdu-Shahtoot', 'assets/images/books/samar-e-urdu-shahtoot-playgroup.jpg', '48')]),
                    'nursery' => $class('Nursery', [$book('Samar e Urdu Kaila Nursery TG', 'assets/ebooks/urdu/Samar-e-Urdu-Kaila', 'assets/images/books/samar-e-urdu-kaila-nursery.jpg', '65')]),
                    'kg-1' => $class('KG-I', [$book('Samar e Urdu Aaroo KG-I TG', 'assets/ebooks/urdu/Samar-e-Urdu-Aaroo', 'assets/images/books/samar-e-urdu-aroo-kg-1.jpg', '57')]),
                    'kg-2' => $class('KG-II', [$book('Samar e Urdu Amrood KG-II TG', 'assets/ebooks/urdu/Samar-e-Urdu-Amrood', 'assets/images/books/samar-e-urdu-amrood-kg-2.jpg', '43')]),
                ],
            ],
            'urdu-dhanak' => [
                'name' => 'Urdu Dhanak Series',
                'description' => 'Dhanak Urdu teaching guides for Classes 1 to 8.',
                'icon' => 'fa-feather-pointed',
                'classes' => [],
            ],
            'islamiat' => [
                'name' => 'Islamiat',
                'description' => 'Mera Pyara Deen Islam and Islamiat Lazmi guides.',
                'icon' => 'fa-mosque',
                'classes' => [],
            ],
            'computer' => [
                'name' => 'Computer / Digital Discovery',
                'description' => 'Digital Discovery lesson plans and worksheets.',
                'icon' => 'fa-computer',
                'classes' => [],
            ],
        ];

        foreach (range(1, 8) as $grade) {
            $subjects['mathematics']['classes']["class-{$grade}"] = $class("Class {$grade}", [
                $book("Maths Stars {$grade} TG", "assets/ebooks/math/Maths-Star-{$grade}", "assets/images/books/mathstar-grade-{$grade}.jpg", [
                    95, 65, 150, 159, 145, 73, 72, 49,
                ][$grade - 1]),
            ]);

            $urduBooks = [
                1 => ['Samar e Urdu Aam', 'samar-e-urdu-aam-class-1.jpg', 80],
                2 => ['Samar e Urdu Aanar', 'samar-e-urdu-anar-class-2.jpg', 80],
                3 => ['Samar e Urdu Angoor', 'samar-e-urdu-angoor-class-3.jpg', 109],
                4 => ['Samar e Urdu Saib', 'samar-e-urdu-saib-class-4.jpg', 108],
                5 => ['Samar e Urdu Santra', 'samar-e-urdu-santra-class-5.jpg', 112],
                6 => ['Samar e Urdu Neem', 'samar-e-urdu-neem-class-6.jpg', 126],
                7 => ['Samar e Urdu Sanober', 'samar-e-urdu-snobar-class-7.jpg', 109],
                8 => ['Samar e Urdu Amaltas', 'samar-e-urdu-amaltas-class-8.jpg', 103],
            ];
            [$title, $image, $pages] = $urduBooks[$grade];
            $subjects['urdu']['classes']["class-{$grade}"] = $class("Class {$grade}", [
                $book("{$title} Class {$grade} TG", "assets/ebooks/urdu/Urdu-Class-{$grade}-TG", "assets/images/books/{$image}", (string) $pages),
            ]);
        }

        $dhanakBooks = [
            1 => ['Dhanak Urdu Laal', 'Dhanak-Laal-TG', 'dhanak-urdu-laal-1.jpg', 79],
            2 => ['Dhanak Urdu Neela', 'Dhanak-Neela', 'dhanak-urdu-neela-2.jpg', 112],
            3 => ['Dhanak Urdu Peela', 'Dhanak-Peela', 'dhanak-urdu-peela-3.jpg', 102],
            4 => ['Dhanak Urdu Hara', 'Dhanak-Hara', 'dhanak-urdu-hara-4.jpg', 116],
            5 => ['Dhanak Urdu Naranji', 'Dhanak-Narangi', 'dhanak-urdu-narangi-5.jpg', 114],
            6 => ['Dhanak Urdu Jamni', 'Dhanak-Urdu-Jamni', 'dhanak-urdu-jamni-6.jpg', 94],
            7 => ['Dhanak Urdu Unabi', 'Dhanak-Urdu-Unabi-Class-7', 'dhanak-urdu-unabi-7.jpg', 119],
            8 => ['Dhanak Urdu Safaid', 'Dhanak-Urdu-Safaid-Class-8', 'dhanak-urdu-safaid-8.jpg', 108],
        ];

        foreach ($dhanakBooks as $grade => [$title, $url, $image, $pages]) {
            $subjects['urdu-dhanak']['classes']["class-{$grade}"] = $class("Class {$grade}", [
                $book("{$title} Class {$grade}", "assets/ebooks/urdu-dhanak/{$url}", "assets/images/books/{$image}", (string) $pages),
            ]);
        }

        $specialDhanak = [
            6 => ['Dhanak Urdu Jamni', 'Dhanak-Urdu-Jamni-6', 'dhanak-special-urdu-jamni-6.jpg', 90],
            7 => ['Dhanak Urdu Unabi', 'Dhanak-Urdu-Unabi-Class-7', 'dhanak-special-urdu-unabi-7.jpg', 137],
            8 => ['Dhanak Urdu Safaid', 'Dhanak-Urdu-Safaid-Class-8', 'dhanak-special-urdu-safaid-8.jpg', 114],
        ];

        foreach ($specialDhanak as $grade => [$title, $url, $image, $pages]) {
            $subjects['urdu-dhanak']['classes']["class-{$grade}"]['books'][] = $book(
                "{$title} Special Edition Class {$grade}",
                "assets/ebooks/urdu-dhanak-special/{$url}",
                "assets/images/books/{$image}",
                (string) $pages
            );
        }

        foreach (range(3, 8) as $grade) {
            $subjects['islamiat']['classes']["class-{$grade}"] = $class("Class {$grade}", [
                $book("Mera Pyara Deen Islam Class {$grade}", "assets/ebooks/islamiyat/Islamiat-Class-{$grade}-TG", "assets/images/books/mera-piyara-deen-e-islam-class-{$grade}.jpg", [
                    59, 73, 67, 63, 64, 65,
                ][$grade - 3]),
                $book("Islamiat Lazmi Class {$grade} TG", "assets/ebooks/islamiyat/Islamiat-Lazmi-Class-{$grade}-TG", "assets/images/books/islamiat-lazmi-class-{$grade}.jpg", [
                    72, 86, 84, 93, 103, 85,
                ][$grade - 3]),
            ]);
        }

        foreach (range(1, 8) as $grade) {
            $subjects['computer']['classes']["class-{$grade}"] = $class("Class {$grade}", [
                $book('Lesson Plan', "assets/ebooks/computer/lesson/Grade-{$grade}/index.html", null, null),
                $book("Teacher's Worksheet", "assets/ebooks/computer/worksheets/Grade-{$grade}/index.html", null, null),
            ]);
        }

        return $subjects;
    }
}
