<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Option;


class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $options = [
            [
                "A" => "Hyper Trainer Marking Language",
                "B" => "Hyper Text Markup Language",
                "C" => "High Tech Modern Language",
                "D" => "Home Tool Markup Language",
                "correct" => "B"
            ],
            [
                "A" => "<link>",
                "B" => "<a>",
                "C" => "<href>",
                "D" => "<url>",
                "correct" => "B"
            ],
            [
                "A" => "Colorful Style Sheets",
                "B" => "Computer Style Sheets",
                "C" => "Cascading Style Sheets",
                "D" => "Creative Style Sheets",
                "correct" => "C"
            ],
            [
                "A" => "HTML",
                "B" => "CSS",
                "C" => "Java",
                "D" => "SQL",
                "correct" => "B"
            ],
            [
                "A" => "<ul>",
                "B" => "<ol>",
                "C" => "<li>",
                "D" => "<list>",
                "correct" => "A"
            ],
            [
                "A" => ".js",
                "B" => ".java",
                "C" => ".script",
                "D" => ".html",
                "correct" => "A"
            ],
            [
                "A" => "function myFunction() {}",
                "B" => "def myFunction()",
                "C" => "create myFunction()",
                "D" => "function:myFunction()",
                "correct" => "A"
            ],
            [
                "A" => "Bootstrap",
                "B" => "Laravel",
                "C" => "React",
                "D" => "MySQL",
                "correct" => "C"
            ],
            [
                "A" => "font-color",
                "B" => "text-color",
                "C" => "color",
                "D" => "style",
                "correct" => "C"
            ],
            [
                "A" => "// This is a comment",
                "B" => "/* This is a comment */",
                "C" => "<!-- This is a comment -->",
                "D" => "# This is a comment",
                "correct" => "C"
            ],
            [
                "A" => "Python",
                "B" => "JavaScript",
                "C" => "HTML",
                "D" => "PHP",
                "correct" => "C"
            ],
            [
                "A" => "px",
                "B" => "em",
                "C" => "cm",
                "D" => "mm",
                "correct" => "B"
            ],
            [
                "A" => "text-weight",
                "B" => "bold",
                "C" => "font-weight",
                "D" => "weight",
                "correct" => "C"
            ],
            [
                "A" => "Moves an element to the left",
                "B" => "Changes text alignment to left",
                "C" => "Rotates an element",
                "D" => "Adds space on the left",
                "correct" => "A"
            ],
            [
                "A" => "background: red;",
                "B" => "background-color: red;",
                "C" => "color: background red;",
                "D" => "bg-color: red;",
                "correct" => "B"
            ],
            [
                "A" => "<footer>",
                "B" => "<section>",
                "C" => "<article>",
                "D" => "<highlight>",
                "correct" => "D"
            ],
            [
                "A" => "Defines page encoding",
                "B" => "Adds a title",
                "C" => "Sets the background color",
                "D" => "Links to an external stylesheet",
                "correct" => "A"
            ],
            [
                "A" => "font-size",
                "B" => "text-style",
                "C" => "font-weight",
                "D" => "text-size",
                "correct" => "A"
            ],
            [
                "A" => "Server",
                "B" => "Browser",
                "C" => "Database",
                "D" => "Operating System",
                "correct" => "B"
            ],
            [
                "A" => "<link rel='stylesheet' href='styles.css'>",
                "B" => "<style src='styles.css'>",
                "C" => "<css link='styles.css'>",
                "D" => "<stylesheet>styles.css</stylesheet>",
                "correct" => "A"
            ]
        ];


        // protected $fillable = ['option', 'question_id', 'is_true'];


        $i = 1;

        foreach ($options as $optionArray) {

            foreach($optionArray as $singleKey => $singleOption) {

                if ($singleKey == "correct") continue;

                $is_ture = false;

                if($optionArray["correct"] == $singleKey){
                    $is_ture = true;
                }

                Option::create([

                    'option' =>  $singleOption,
                    'question_id' => $i,
                    'is_true' => $is_ture,
                ]);

            }


            $i++;
        }




    }
}
