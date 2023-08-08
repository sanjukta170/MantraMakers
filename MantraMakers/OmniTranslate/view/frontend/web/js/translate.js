require(['jquery', 'domReady!'], function ($) {
    $ = jQuery;
    const collectionData = window.translatedData;
    console.log(collectionData);

    //iterate through the collection and replace the string
    collectionData.forEach((data) => {
        let changedstring = $(data.classname).html().replace(data.targetvalue, data.translationvalue);
        $(data.classname).html(changedstring);
    });
});
