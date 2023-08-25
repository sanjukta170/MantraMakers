define([
    'Magento_Ui/js/form/components/button',
    'uiRegistry',
    'jquery'
], function (Button, registry, $) {
    'use strict';
console.log('loaded');
    return Button.extend({
        action: function(){
            let targetValue = registry.get('inputName = omnitranslate_information[targetvalue]');
            let translationValue = registry.get('inputName = omnitranslate_information[translationvalue]');
            let languageSelect = registry.get('index = language_select');
            let isAutoTranslate = registry.get('index = isautotranslate');
            if (targetValue.value()) {
                const targetLanguage = languageSelect.value().replace(/_/g, '-');
                const requestUrl = 'https://mymemory.translated.net/api/ajaxfetch?q='
                    + targetValue.value() + '&langpair=en-GB|'+ targetLanguage +'&mtonly=1';
                $.ajax({
                    url: requestUrl,
                    type: 'GET',
                    showLoader: false
                }).then((data) => {
                    if(data.responseStatus === 200) {
                        translationValue.value(data.responseData.translatedText);
                        translationValue.disable(true);
                        isAutoTranslate.value("1");
                        isAutoTranslate.disabled(true);
                    } else {
                        console.log('something went wrong with the translation api');
                        console.log(data.responseData.translatedText);
                        isAutoTranslate.value("0");
                        isAutoTranslate.disabled(false);
                        alert('cant translate now please use own translation');
                    }
                });
            } else {
                targetValue.trigger('validate');
                alert('please fill TargetValue first');
            }
            this._super();
        },
    });
});
