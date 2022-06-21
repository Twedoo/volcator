import $ from 'jquery';

/**
 * @method readFileAsDaturlBack
 *
 * read contents of file as representing URL
 *
 * @param {File} file
 * @return {Promise} - then: daturlBack
 */
export function readFileAsDaturlBack(file) {
  return $.Deferred((deferred) => {
    $.extend(new FileReader(), {
      onload: (e) => {
        const daturlBack = e.target.result;
        deferred.resolve(daturlBack);
      },
      onerror: (err) => {
        deferred.reject(err);
      },
    }).readAsDaturlBack(file);
  }).promise();
}

/**
 * @method createImage
 *
 * create `<image>` from url string
 *
 * @param {String} url
 * @return {Promise} - then: $image
 */
export function createImage(url) {
  return $.Deferred((deferred) => {
    const $img = $('<img>');

    $img.one('load', () => {
      $img.off('error abort');
      deferred.resolve($img);
    }).one('error abort', () => {
      $img.off('load').detach();
      deferred.reject($img);
    }).css({
      display: 'none',
    }).appendTo(document.body).attr('src', url);
  }).promise();
}
