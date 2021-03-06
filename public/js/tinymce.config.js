//tinyMCE.baseURL = "http://192.168.0.10:8088/plugins/tinymce/js/tinymce/plugins/";
//alert(tinyMCE.baseURL);
tinymce.init(
  {
    selector: "textarea",
    height: 500,
    plugins: [
      "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern jbimages"
    ],

    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | insertdatetime preview | forecolor backcolor",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code",
    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
    toolbar4: "styleselect formatselect | fontselect fontsizeselect | jbimages",

    menubar: false,
    toolbar_items_size: 'small',

    style_formats: [
      {
        title: 'Bold text',
        inline: 'b'
      },
      {
        title: 'Red text',
        inline: 'span',
        styles: {
          color: '#ff0000'
        }
      },
      {
        title: 'Red header',
        block: 'h1',
        styles: {
          color: '#ff0000'
        }
      },
      {
        title: 'Example 1',
        inline: 'span',
        classes: 'example1'
      },
      {
        title: 'Example 2',
        inline: 'span',
        classes: 'example2'
      },
      {
        title: 'Table styles'
      },
      {
        title: 'Table row 1',
        selector: 'tr',
        classes: 'tablerow1'
      }
    ],
    templates: [
      {
        title: 'Test template 1',
        content: 'Test 1'
      },
      {
        title: 'Test template 2',
        content: 'Test 2'
      }
    ],
    content_css: [
      '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
      '//www.tinymce.com/css/codepen.min.css'
    ],
    relative_urls : false,
remove_script_host : true,
document_base_url : "/",
convert_urls : true
  }
);
