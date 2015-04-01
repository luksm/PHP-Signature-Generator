Signature Generator
=======

A super simple script to help everyone that ever had to create an corporate HTML signature, this will fill all the information on a layout file and download it.

## Usage

It's dead simple to use this, just edit **layout.html** to have your signature code and replate the content with **tags**

For regular field values:

    [[NAME]]

For conditional fields:

    [[IF-MOBILE]][[MOBILE]][[ENDIF-MOBILE]]

For booleans, such as a checkbox, you can use a default value that is displayed (but not editable) if the user wants to:

    [[IF-WEBSITE]]http://www.example.com[[ENDIF-WEBSITE]]

Any HTML can be included within if-statements.

The field names correspond with the name attribute on the form element, i.e. Sender[example]. This means that you can easily add any other field you'd like as long as you follow that same structure.

You can have all the coding you want to have, just add these and the code will replace it for you!

Spread the love!
