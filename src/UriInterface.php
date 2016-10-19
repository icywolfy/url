<?php
namespace DeepFreeze\Uri;

/**
 * Value Object representing a RFC-3986 URI.
 *
 * As the PSR-7 UriInterface is tuned towards HTTP URIs, it explicitly prevents
 * distinctions required under the RFC-3986 normalization rules to be maintained.
 * This class and structure are thus functionally incompatible, but will non-the-less
 * be interface compatible for ease of portability.
 *
 * Implementations of this interface are considered read-only.
 *
 *
 * For an implementation that requires mutability, the use of a UriBuilder class is recommended.
 *
 * This will allow for the building of a URI in a manner that can be used to create appropriate
 * scheme based sub-classes that can validate against specific scheme definitions.
 *
 * @see http://tools.ietf.org/html/rfc3986
 *
 */
interface UriInterface {
  /**
   * Get the scheme portion of the URI.
   *
   * If no scheme is present, this function must return an empty string.
   *
   * The value MUST be normalized to lowercase as per RFC3986 6.2.2.1
   *
   * The scheme must follow the definition presented in RFC 3986 3.1
   *
   * A valid scheme is defined as an initial ALPHA character, followed by any number
   * of ALHPA, DIGIT, and the symbols: "+", "-", "."
   *
   * ALPHA = [a-zA-Z]
   * scheme = ALPHA *( ALPHA / DIGIT / "+" / "-" / "." )
   *
   * @see http://tools.ietf.org/html/rfc3986#section-3.1
   * @return string
   */
  public function getScheme();


  /**
   * Get the authority portion of the URI
   *
   * If no scheme is present this method MUST return:
   *  NULL if the scheme is undefined
   *  ""   if the scheme is empty
   *
   * This distinction is required per RFC 3986 Normalization.
   * The Authority Prefix ("//") MUST NOT be returned as part of this string
   * If the port is empty, implementation SHOULD NOT produce the ":" delimiter
   *
   * @see https://tools.ietf.org/html/rfc3986#section-3.2
   * @return string|null The URI authority, in "[user-info@]host[:port]" format; NULL if undefined.
   */
  public function getAuthority();
  public function getHost();
  public function getUserInfo();
  public function getPort();


  /**
   * Return the path segment of the URI.
   *
   * @return string
   */
  public function getPath();
  public function getQuery();
  public function getFragment();



  /**
   * Return the normalized URI represented.
   *
   * If the individual components combine to produce an invalid URI as per RFC 3986, then
   * a conforming implementation MUST return NULL.
   *
   * NOTE: Any scheme-dependent restrictions which are violated MUST NOT result in a NULL
   * response.
   * For example, the "HOST" portion is required per the HTTP scheme definition, but is
   * optional per RFC 3986.  Thus, the URI "http:/path" and "http:///path", which are
   * invalid per the "http" scheme defined by RFC 7230, must be returned intact.
   *
   * A conforming implementation MAY normalize a URI based upon additional scheme-defined
   * normalization rules, if the implementation is aware of such additional normalization
   * rules.
   *
   *
   * RFC 3986 is the authoritative source of how to properly generate a normalized URI,
   * as well as which combinations are
   * @return string Normalized URI | "" if the generated URI would violate RFC 3986.
   */
  public function __toString();
}
