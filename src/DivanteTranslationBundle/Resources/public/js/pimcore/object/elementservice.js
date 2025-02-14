pimcore.registerNS("pimcore.object.elementservice.x");

pimcore.object.elementservice.translateButton = function (id, fieldName, component, type, lang) {
    const provider = pimcore.globalmanager.get('translationBundle_provider');

    if (provider === 'deepl' || provider === 'deepl_free') {
        return new Ext.Button({
            iconCls: "pimcore_icon_translations",
            cls: 'pimcore_button_transparent',
            tooltip: t("translate_field"),
            menu: [
                {
                    text: 'Formality Default',
                    handler: function () {
                        handleTranslationRequest(id, fieldName, component, type, lang, 'default')
                    }.bind(this),
                    iconCls: "pimcore_icon_more",
                },
                {
                    text: 'Formality More',
                    handler: function () {
                        handleTranslationRequest(id, fieldName, component, type, lang, 'more')
                    }.bind(this),
                    iconCls: 'pimcore_icon_up'
                },
                {
                    text: 'Formality Less',
                    handler: function () {
                        handleTranslationRequest(id, fieldName, component, type, lang, 'less')
                    }.bind(this),
                    iconCls: 'pimcore_icon_down'
                },
            ],
            style: "margin-left: 10px; filter:grayscale(100%);",
        });
    } else {
        return new Ext.Button({
            iconCls: "pimcore_icon_translations",
            cls: 'pimcore_button_transparent',
            tooltip: t("translate_field"),
            handler: function () {
                handleTranslationRequest(id, fieldName, component, type, lang, '')
            }.bind(this),
            style: "margin-left: 10px; filter:grayscale(100%);",
        });
    }
};

function handleTranslationRequest(id, fieldName, component, type, lang, formality) {
    Ext.Ajax.request({
        url: "/admin/object/translate-field",
        method: "GET",
        params: {
            sourceId: id,
            fieldName: fieldName,
            lang: lang,
            type: type,
            formality: formality
        },
        success: function (response) {
            const res = Ext.decode(response.responseText);

            if (res.success) {
                switch (type) {
                    case 'wysiwyg':
                        tinymce.activeEditor.setContent(res.data);
                        break;
                    case 'input':
                        component.setRawValue(res.data);
                        break;
                    case 'textarea':
                        component.component.setValue(res.data);
                        break;
                }
            } else {
                pimcore.helpers.showPrettyError('object', t("error"), t("saving_failed"), res.message);
            }
        }
    });
}
