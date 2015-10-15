<?php

namespace Woofem;

class CSRF
{

  /**
   * @return string CSRF Token.
   *
   * Sample usage - When rendering the form:
   * <form method="POST" action="">
   *   ...
   *   <input type="hidden" name="tokenName" value="<?php generateToken(tokenName) ?>" />
   *   ...
   * </form>
   */
  static function generateToken($tokenName = 'token') {
    $token = empty($_SESSION[$tokenName]) ? false : $_SESSION[$tokenName];
    $expires = empty($_SESSION[$tokenName . 'Expires']) ? false : $_SESSION[$tokenName . 'Expires'];
    if (!$token || ($expires < time())) {
      $token = md5(uniqid(mt_rand(), true));
      $_SESSION[$tokenName] = $token;
    }
    $_SESSION[$tokenName . 'Expires'] = time() + 14400; // Four hours
    return $token;
  }

  /**
   * @return bool True if token validated successfully.
   *
   * Sample usage: Within the form POST processing code simply call this
   * function. If valid token, returns true, proceeds. Else dies.
   */
  static function validateToken($tokenName = 'token') {
    $token = empty($_SESSION[$tokenName]) ? false : $_SESSION[$tokenName];
    $expires = empty($_SESSION[$tokenName . 'Expires']) ? false : $_SESSION[$tokenName . 'Expires'];
    $check = empty($_POST[$tokenName]) ? false : $_POST[$tokenName];
    if ($token && ($token == $check) && ($expires > time())) {
      // SUCCESS - Process the form
      return TRUE;
    } else {
      // FAILURE - Block this:
      header('HTTP/1.1 403 Forbidden');
      die;
    }
  }

}