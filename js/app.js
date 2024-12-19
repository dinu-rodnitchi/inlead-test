
(function (Drupal, once, drupalSettings) {
  "use strict";
  Drupal.behaviors.reactLink = {
    attach(context, settings) {

      once('reactLink', '#react-app').forEach(function (element) {
        render();
      });

      function render() {
        const root = document.getElementById("react-app");
        if (root) {

          // React component / main component.
          function DrupalLink(props) {
            return React.createElement('div', null, props.link);
          }


          // Link element, will be passed as props to the main component.
          const link = drupalSettings.react_link || 'The link was not set, go ahead and set it in the block configuration.';
          const linkElement = React.createElement("a", { href: link }, link);

          // Render the main component.
          ReactDOM.render(
            React.createElement(DrupalLink, { link: linkElement }),
            root
          );
        }
      }
    }
  };
})(Drupal, once, drupalSettings);
