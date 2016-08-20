Dies ist das Repository der Website von Left Wing Hacker.

# Contentpflege
Neue Inhalte müssen in die Datei content.json eingepflegt werden.

Dabei hat eine Seite folgende Keys:
- title: Titel der Seite (für das Inhaltsverzeichnis und das HTML-title-Tag)
- id: Kurz-ID der Seite (bitte nur a-zA-Z0-9- verwenden)
- children: sofern vorhanden, ein Array von Seiten

Das HTML der Seite wird unter _fragments abgelegt, kaskadierend nach den
id's der darüberliegenden Seiten.

Innerhalb einer Seite oder eines Templates können folgende Platzhalter
verwendet werden:
- {content}: im Template Platzhalter für den Content der Seite aus _fragments
- {toc}: im Template Platzhalter für das Inhaltsverzeichnis (kaskadierendes ol/li)
- {base}: Basis-URL für relative URLs (standardmäßig https://leftwinghacker.github.io)
- {title}: Platzhalter für den Titel der Seite
- {pageid}: Eindeutige ID der Seite (bestehend aus einer Konkatenation der IDs der Seite und aller Oberseiten)
- {ref http://example.com/path 'Seitenname' 'Seitentitel'}: Erzeugt einen Verweis auf die Fußnote

# Rendern der Seite
Das Neu-Ausspielen aller Seiten wird ausgelöst durch den Aufruf

    php _scripts/render.php [base]

wobei base optional ist (standardmäßig https://leftwinghacker.github.io).

# Änderungen vorschlagen
Jede/r Interessierte kann auf GitHub sowie per Mail an leftwinghacker@gmail.com
Änderungen vorschlagen.

Bei direkten Patches gegen das Repository bitte beachten:
- Zeichenkodierung standardmäßig UTF-8
- Einrückung per Tabulator
- Gender-Schreibweise Binnen-I (ist allerdings keine Pflicht)

Sofern gewünscht, kann ein Eintrag in den Credits-Abschnitt erfolgen.

# Lizenz
Die Seite ist unter der Lizenz CC-BY-NC-SA 3.0 veröffentlicht. Das bedeutet:
- Namensnennung — Sie müssen angemessene Urheber- und Rechteangaben machen, einen Link zur Lizenz beifügen und angeben, ob Änderungen vorgenommen wurden. Diese Angaben dürfen in jeder angemessenen Art und Weise gemacht werden, allerdings nicht so, dass der Eindruck entsteht, der Lizenzgeber unterstütze gerade Sie oder Ihre Nutzung besonders.
- Nicht kommerziell — Sie dürfen das Material nicht für kommerzielle Zwecke nutzen.
- Weitergabe unter gleichen Bedingungen — Wenn Sie das Material remixen, verändern oder anderweitig direkt darauf aufbauen, dürfen Sie Ihre Beiträge nur unter derselben Lizenz wie das Original verbreiten.

Kommerzielle Projekte dürfen den Inhalt nach Freigabe per Mail gerne nutzen;
dies soll hauptsächlich die Verwendung des Inhalts durch Faschisten und
deren Strukturen erschweren.
