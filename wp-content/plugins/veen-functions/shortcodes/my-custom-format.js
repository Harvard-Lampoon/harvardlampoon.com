/**
 *
 * -----------------------------------------------------------
 *
 * Codestar Framework Gutenberg Block
 * A Simple and Lightweight WordPress Option Framework
 *
 * -----------------------------------------------------------
 *
 */
( function( blocks, blockEditor, element, components ) {

    // if( !window.csf_gutenberg_blocks ) { return; }
  

  
      var registerBlockType = blocks.registerBlockType;
      var PlainText         = blockEditor.PlainText;
      var createElement     = element.createElement;
      var RawHTML           = element.RawHTML;
      var Button            = components.Button;
      console.log(components);
  
      registerBlockType('my-custom-format/sample-output', {
        title: 'EP Shortcodes',
        // icon: block.gutenberg.icon,
        category: 'formatting',
        description: 'asd',
        // keywords: block.gutenberg.keywords,
        supports: {
          html: false,
          className: false,
          customClassName: false,
        },
        attributes: {
          shortcode: {
            string: 'string',
            source: 'text',
          }
        },
        edit: function (props) {
          return (
            createElement('div', {className: 'csf-shortcode-block'},
  
              createElement(Button, {
                'data-modal-id': 'asd',
                'data-gutenberg-id': 'ep-shortcodes',
                className: 'is-secondary csf-shortcode-button',
                onClick: function () {
                  window.csf_gutenberg_props = props;
                },
              }, 'EP Shortcodes' ),

              createElement(components.Modal, {
                'data-modal-id': 'asd',
                'data-gutenberg-id': 'ep-shortcodes',
                className: 'is-secondary csf-shortcode-button',
                onClick: function () {
                  window.csf_gutenberg_props = props;
                },
              }, 'EP Shortcodes' ),
  
              createElement(PlainText, {
                placeholder: 'Placeholder',
                className: 'input-control',
                onChange: function (value) {
                  props.setAttributes({
                    shortcode: value
                  });
                },
                value: props.attributes.shortcode
              })
  
            )
          );
        },
        save: function (props) {
          return createElement(RawHTML, {}, props.attributes.shortcode);
        }
      });
  

  
  })(
    window.wp.blocks,
    window.wp.blockEditor,
    window.wp.element,
    window.wp.components
  );
  