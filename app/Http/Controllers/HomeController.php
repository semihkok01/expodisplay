<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'features' => [
                [
                    'icon' => 'spark',
                    'title' => 'Hohe Sichtbarkeit',
                    'text' => 'Klare Platzierung und präzise Inhalte sorgen dafür, dass Ihre Botschaft sofort wahrgenommen wird.',
                ],
                [
                    'icon' => 'bolt',
                    'title' => 'Schnelle Inbetriebnahme',
                    'text' => 'Installation, Content-Setup und Ausspielung werden effizient aus einer Hand umgesetzt.',
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Laufender Support',
                    'text' => 'Monitoring, Updates und Betreuung halten Ihr System stabil und einsatzbereit.',
                ],
                [
                    'icon' => 'chart',
                    'title' => 'Messbare Wirkung',
                    'text' => 'Kampagnen werden auf reale Kontaktpunkte und messbare Ergebnisse vor Ort ausgerichtet.',
                ],
            ],
            'showcases' => [
                [
                    'eyebrow' => 'Problem',
                    'title' => 'Unklare Besucherführung im Store',
                    'text' => 'Ohne klare Orientierung verlieren Kunden Zeit und Aufmerksamkeit. Displays übernehmen die gezielte Lenkung zu Angeboten und Aktionen.',
                    'result' => '+ Mehr Interaktion am Point of Sale',
                    'accent' => 'blue',
                ],
                [
                    'eyebrow' => 'Wirkung',
                    'title' => 'Markenauftritt mit Premium-Präsenz',
                    'text' => 'Hochwertige Screen-Kompositionen heben Produkte sichtbar auf ein neues Niveau – konsistent, modern und markenstark.',
                    'result' => 'Stärkere Wahrnehmung & höherer Qualitäts-Eindruck',
                    'accent' => 'orange',
                ],
                [
                    'eyebrow' => 'Kontrolle',
                    'title' => 'Kampagnen in Echtzeit steuern',
                    'text' => 'Event-Updates, Preisaktionen oder Live-Inhalte lassen sich zentral verwalten und sofort ausspielen – ohne operative Hürden.',
                    'result' => '24/7 flexibel & sofort einsatzbereit',
                    'accent' => 'green',
                ],
            ],
            'videoShowcaseItems' => [
                [
                    'src' => asset('assets/videos/screen_01.mp4'),
                    'title' => 'Golfreisen-Kampagne',
                    'label' => 'Display 01',
                ],
                [
                    'src' => asset('assets/videos/screen_02.mp4'),
                    'title' => 'Reise-Promo im Loop',
                    'label' => 'Display 02',
                ],
                [
                    'src' => asset('assets/videos/screen_03.mp4'),
                    'title' => 'Vertikaler Spot mit hoher Wirkung',
                    'label' => 'Display 03',
                ],
                [
                    'src' => asset('assets/videos/screen_04.mp4'),
                    'title' => 'Dynamische Store-Kampagne',
                    'label' => 'Display 04',
                ],
            ],
            'audiences' => [
                [
                    'icon' => 'booth',
                    'title' => 'Messen',
                    'text' => 'Starker Auftritt am Stand – Inhalte sekundenschnell anpassen.',
                ],
                [
                    'icon' => 'flag',
                    'title' => 'Golfclubs',
                    'text' => 'Greenfee, Events und Reisen sichtbar bewerben – direkt vor Ort.',
                ],
                [
                    'icon' => 'store',
                    'title' => 'Retail',
                    'text' => 'Kundenfluss lenken und Aktionen am Point of Sale pushen.',
                ],
                [
                    'icon' => 'frame',
                    'title' => 'Showrooms',
                    'text' => 'Produkte hochwertig inszenieren – wie ein Premium-Schaufenster.',
                ],
                [
                    'icon' => 'bed',
                    'title' => 'Hotels',
                    'text' => 'Infos, Angebote und Upsells elegant im Eingangsbereich platzieren.',
                ],
                [
                    'icon' => 'cross',
                    'title' => 'Krankenhäuser',
                    'text' => 'Wegführung, Hinweise und Updates klar und zentral ausspielen.',
                ],
            ],
            'testimonials' => [
                [
                    'quote' => 'Im neuen Kampagnenzeitraum wurde der Schaufenster-Traffic deutlich zielgerichteter. Das Screen-Konzept hat den Einstieg in den Store spürbar erhöht.',
                    'name' => 'Ece Kara',
                    'role' => 'Marketing Managerin, Nova Retail',
                ],
                [
                    'quote' => 'Die Installation war schnell, die Content-Übergänge sauber. Die Displays laufen ohne zusätzliche Belastung für unser Team.',
                    'name' => 'Mert Aydin',
                    'role' => 'Operations Lead, Urban Hub',
                ],
                [
                    'quote' => 'Unser Markenauftritt wirkt deutlich hochwertiger. Besonders an Launch-Tagen hat sich die Aufmerksamkeit klar verlängert.',
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
                    'label' => 'längere Verweildauer im Store',
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
                    'answer' => 'Das hängt vom Standort ab. In der Regel sind Planung, Aufbau und der erste Content-Setup in kurzer Zeit abgeschlossen.',
                ],
                [
                    'question' => 'Verwalten wir die Inhalte selbst?',
                    'answer' => 'Ja. Sie können die Inhalte selbst steuern oder unser Team übernimmt die Kampagnenausspielung. Beides läuft auf derselben Infrastruktur.',
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
