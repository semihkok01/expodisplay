<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $galleryCaptions = [
            'Intelligenter Werbekiosk - starker erster Eindruck',
            'High-Brightness-Display - in jeder Umgebung klar',
            'Kampagnenfokussiertes Design - steigert Conversion',
            'Instore-Navigation - lenkt den Kundenfluss',
            'Event-Modus - sofortige Ankuendigungen',
            'Marken-Schaufenster - premium Auftritt',
            'Produktlaunch - aufmerksamkeitsstarke Praesentation',
            'QR fuer schnelle Interaktion - messbare Ergebnisse',
            'Dynamische Inhalte - leicht aktualisierbar',
            'Installation und Support - alles aus einer Hand',
        ];

        $galleryItems = [];

        foreach ($galleryCaptions as $index => $caption) {
            $number = $index + 1;
            $basename = sprintf('ad_%02d', $number);
            $jpgPath = public_path("assets/gallery/{$basename}.jpg");
            $galleryItems[] = [
                'src' => file_exists($jpgPath)
                    ? asset("assets/gallery/{$basename}.jpg")
                    : asset("assets/gallery/{$basename}.svg"),
                'caption' => $caption,
                'tag' => match ($number % 5) {
                    1 => 'Premium',
                    2 => 'Wirkung',
                    3 => 'Conversion',
                    4 => 'Erlebnis',
                    default => 'Support',
                },
                'width' => file_exists($jpgPath) ? 1600 : 1200,
                'height' => file_exists($jpgPath) ? 1200 : 900,
            ];
        }

        return view('home', [
            'features' => [
                [
                    'icon' => 'spark',
                    'title' => 'Hohe Sichtbarkeit',
                    'text' => 'Mit starkem Screen-Design, klarer Platzierung und praezisen Botschaften wird Ihre Marke sofort wahrgenommen.',
                ],
                [
                    'icon' => 'bolt',
                    'title' => 'Schnelle Inbetriebnahme',
                    'text' => 'Installation, Content-Setup und Ausspielung werden kompakt und effizient aus einer Hand umgesetzt.',
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Laufender Support',
                    'text' => 'Mit technischem Monitoring, Updates und operativer Betreuung bleibt das System stabil im Einsatz.',
                ],
                [
                    'icon' => 'chart',
                    'title' => 'Messbare Wirkung',
                    'text' => 'Wir verbinden starke Kampagnen mit realen Kontaktpunkten vor Ort und richten alles auf Ergebnisse aus.',
                ],
            ],
            'showcases' => [
                [
                    'title' => 'Instore-Navigation',
                    'text' => 'Ein intelligenter Screen-Flow fuehrt Besucher zur richtigen Aktion, zum richtigen Produkt und zur passenden Kampagne.',
                    'chips' => ['Navigation', 'QR', 'Kampagne'],
                    'accent' => 'blue',
                ],
                [
                    'title' => 'Premium-Flow fuer Schaufenster',
                    'text' => 'Ein praesenter, aber kontrollierter Auftritt hebt Produkt und Markenbild sichtbar auf ein hoeheres Niveau.',
                    'chips' => ['Schaufenster', 'Marktstart', 'Branding'],
                    'accent' => 'orange',
                ],
                [
                    'title' => 'Event- und Live-Update-Modus',
                    'text' => 'Zeitkritische Kampagnen, Event-Ablaufe und spontane Aenderungen lassen sich zentral und schnell ausspielen.',
                    'chips' => ['Live', 'Sofort', '24/7'],
                    'accent' => 'green',
                ],
            ],
            'galleryItems' => $galleryItems,
            'testimonials' => [
                [
                    'quote' => 'Im neuen Kampagnenzeitraum wurde der Schaufenster-Traffic deutlich zielgerichteter. Das Screen-Konzept hat den Einstieg in den Store spuerbar erhoeht.',
                    'name' => 'Ece Kara',
                    'role' => 'Marketing Managerin, Nova Retail',
                ],
                [
                    'quote' => 'Die Installation war schnell, die Content-Uebergaenge sauber. Die Displays laufen ohne zusaetzliche Belastung fuer unser Team.',
                    'name' => 'Mert Aydin',
                    'role' => 'Operations Lead, Urban Hub',
                ],
                [
                    'quote' => 'Unser Markenauftritt wirkt deutlich hochwertiger. Besonders an Launch-Tagen hat sich die Aufmerksamkeit klar verlaengert.',
                    'name' => 'Selin Demir',
                    'role' => 'Brand Management, Atelier One',
                ],
            ],
            'stats' => [
                [
                    'value' => 35,
                    'prefix' => '%',
                    'suffix' => '',
                    'label' => 'mehr Interaktion',
                ],
                [
                    'value' => 2,
                    'prefix' => '',
                    'suffix' => 'x',
                    'label' => 'laengere Verweildauer im Store',
                ],
                [
                    'value' => 24,
                    'prefix' => '',
                    'suffix' => '/7',
                    'label' => 'laufende Ausspielung',
                ],
            ],
            'faqs' => [
                [
                    'question' => 'Wie lange dauert die Installation?',
                    'answer' => 'Das haengt vom Standort ab. In der Regel sind Planung, Aufbau und der erste Content-Setup in kurzer Zeit abgeschlossen.',
                ],
                [
                    'question' => 'Verwalten wir die Inhalte selbst?',
                    'answer' => 'Ja. Sie koennen die Inhalte selbst steuern oder unser Team uebernimmt die Kampagnenausspielung. Beides laeuft auf derselben Infrastruktur.',
                ],
                [
                    'question' => 'Kann man mit nur einem Screen starten?',
                    'answer' => 'Ja. Das System skaliert von einem einzelnen Standort bis zu mehreren Filialen ohne Plattformwechsel.',
                ],
                [
                    'question' => 'Sind Wartung und Support enthalten?',
                    'answer' => 'Monitoring, Fernzugriff und technischer Support werden passend zum gebuchten Leistungspaket eingeplant.',
                ],
            ],
        ]);
    }
}
