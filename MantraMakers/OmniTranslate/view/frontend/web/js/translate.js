require(['jquery', 'domReady!'], function ($) {
    $ = jQuery;
    const collectionData = window.translatedData;
    // console.log(collectionData);

    //iterate through the collection and replace the string
    const translate = (data) => {
        if (data.targetvaluetype === 'html') {
            if ($(data.classname).html().includes(data.targetvalue)) {
                let changedstring = $(data.classname).html().replace(data.targetvalue, data.translationvalue);
                $(data.classname).html(changedstring);
            }
        } else {
            if ($(data.classname).text().includes(data.targetvalue)) {
                let changedstring = $(data.classname).text().replace(data.targetvalue, data.translationvalue);
                $(data.classname).text(changedstring);
            }
        }
    }

    if (collectionData.length) {
        collectionData.forEach((data) => {
            translate(data);
        });
        $(document).ajaxComplete(function (event, xhr, settings) {
            collectionData.forEach((data) => {
                translate(data);
            });
        });
    }
});
