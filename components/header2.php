<style>
  @color-accent: #177E89;
  @color-light: #ffffff;
  @color-dark: #2a2a2a;
  @menu-link-padding: 20px 25px;
  @breakpoint: 950px;
  @mega-menu-multiLevel-colWidth: 100/3 + 0%;
  @mobile-menu-back-height: ~"calc(1.4em + 40px)";
  @mobile-menu-back-offset: ~"calc(0px - (1.4em + 40px))";
  @menu-mobile-width: 350px;

  body {
    font-family: 'Noto Sans', sans-serif;
    background: #fafafa;
    padding: 0;
    margin: 0;
  }

  *,
  *:before,
  *:after {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
  }




  nav {

    ul,
    li {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    a {
      display: block;
      text-decoration: none;

      &:hover,
      &:visited {
        text-decoration: none;
      }
    }
  }

  .menu-bar {
    background: @color-light;
    display: flex;
  }

  .menu-link {
    padding: @menu-link-padding;
    background: @color-light;
    color: @color-accent;
    transition: background .2s, color .2s;
    position: relative;
    z-index: 1;

    &[aria-haspopup="true"] {
      padding-right: 40px;

      &:after {
        content: "";
        background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1397521/arrowRight.svg#accent');
        background-size: 14px;
        width: 14px;
        height: 14px;
        font-size: 12px;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
      }
    }
  }

  .mega-menu-header {
    font-size: 1.2em;
    text-transform: uppercase;
    font-weight: bold;
    color: darken(@color-accent, 5%);
  }

  .mega-menu {
    background: @color-light;
    z-index: 10;
  }

  .mega-menu--multiLevel {
    flex-direction: column;
  }




  @media all and (min-width: @breakpoint + 1px) {


    .nav {
      margin-top: 50px;
      background: @color-light;

      >nav {
        max-width: 900px;
        margin: 0 auto;
      }
    }

    .menu {
      [aria-haspopup="true"] {
        ~ul {
          display: none;
        }
      }
    }

    .menu-bar {
      position: relative;

      >li {
        >[aria-haspopup="true"] {

          &:after {
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1397521/arrowBottom.svg#accent');
          }

          &:hover {
            &:after {
              background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1397521/arrowBottom.svg#light');
            }
          }


          &:focus {
            ~ul {
              display: flex;
              transform-origin: top;
              animation: dropdown .2s ease-out;
            }
          }

          ~ul {
            &:hover {
              display: flex;
            }
          }
        }


        &:focus-within {
          >[aria-haspopup="true"] {
            ~ul {
              display: flex;
            }
          }
        }


        >[aria-haspopup="true"]:focus,
        &:focus-within>[aria-haspopup="true"],
        &:hover>a {
          background: @color-accent;
          color: @color-light;

          &:after {
            background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1397521/arrowTop.svg#light');
          }
        }
      }
    }

    .mega-menu {

      position: absolute;
      top: 100%;
      left: 0;
      width: 100%;

      &:hover {
        display: flex;
      }

      a {
        &:hover {
          background: tint(@color-accent, 85%);
          color: darken(@color-accent, 5%);
        }
      }
    }


    .mega-menu--multiLevel {

      >li {
        width: @mega-menu-multiLevel-colWidth;

        >[aria-haspopup="true"] {
          ~ul {
            left: @mega-menu-multiLevel-colWidth;
            width: @mega-menu-multiLevel-colWidth;

            ul {
              width: 100%;
              left: 100%;
            }
          }
        }
      }

      li {

        &:hover {
          >[aria-haspopup="true"] {
            ~ul {
              display: block;
              transform-origin: left;
              animation: flyout .2s ease-out;
            }
          }
        }

        &:focus-within {
          >[aria-haspopup="true"] {
            ~ul {
              display: block;
            }
          }
        }


        &:hover,
        &:focus-within {

          >[aria-haspopup="true"],
          >a {
            background: tint(@color-accent, 85%);
            color: darken(@color-accent, 5%);
          }
        }
      }

      [aria-haspopup="true"] {

        ~ul,
        & {
          border-left: 1px solid #f0f0f0;

          &:hover {
            display: block;
          }
        }

        ~ul {
          position: absolute;
          top: 0;
          height: 100%;
        }
      }
    }


    .mega-menu--flat {
      >* {
        flex: 1;
      }
    }


    .mobile-menu-trigger,
    .mobile-menu-header,
    .mobile-menu-back-item {
      display: none;
    }

  }

  @media all and (max-width: @breakpoint) {

    .nav {
      padding: 20px;
    }

    .mobile-menu-trigger,
    .mobile-menu-header,
    .mobile-menu-back-item {
      display: block;
    }

    .mobile-menu-trigger {
      background: @color-accent;
      color: @color-light;
      border: 0;
      padding: 10px;
      font-size: 1.2em;
      border-radius: 4px;
    }

    .mobile-menu-header {
      order: -1;
      background: grey;

      a {
        padding: @menu-link-padding;
        color: @color-light;
        visibility: visible;
      }
    }

    .menu-bar {
      flex-direction: column;
      position: fixed;
      top: 0;
      left: -100%;
      height: 100vh;
      width: @menu-mobile-width;
      max-width: @menu-mobile-width;
      max-width: 90%;
      overflow-x: hidden;
      transition: left .3s;
      box-shadow: 1px 0px 2px 0px rgba(0, 0, 0, 0.25);

      >li {
        >[aria-haspopup="true"] {
          ~ul {
            display: flex;
            flex-direction: column;
            background: @color-light;
            position: absolute;
            left: 100%;
            top: 0;
            max-height: 100vh;
            width: 100%;
            transition: left .3s;

            >li {
              >[aria-haspopup="true"] {
                font-size: 1.2em;

                ~ul {
                  a {
                    padding-left: 40px;
                  }

                  >li {
                    >[aria-haspopup="true"] {
                      ~ul {
                        a {
                          padding-left: 80px;
                        }
                      }
                    }
                  }
                }
              }
            }

            [aria-haspopup="true"] {
              color: @color-dark;

              &:after {
                content: "+";
                background: none;
                font-size: 1em;
                font-weight: normal;
                height: 20px;
                line-height: 1;
              }

              ~ul {
                max-height: 0px;
                transform-origin: top;
                transform: scaleY(0);
                transition: max-height .1s;
              }
            }
          }
        }
      }
    }


    .mega-menu-content {
      padding: @menu-link-padding;
    }

    .mobile-menu-back-item {
      order: -1;

      a {
        background: tint(grey, 70%);
        color: @color-dark;
        max-height: @mobile-menu-back-height;
        margin-top: @mobile-menu-back-offset;
        pointer-events: none;

        &:before {
          content: "";
          width: 14px;
          height: 12px;
          background-image: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/1397521/arrowLeft.svg#default');
          background-size: 14px;
          margin-right: 10px;
          display: inline-block;
        }
      }
    }



    .mobile-menu-trigger {

      &:focus {
        ~ul {
          left: 0;
        }
      }
    }

    .menu-bar {

      &:hover,
      &:focus-within {
        left: 0;
      }

      >li {
        >[aria-haspopup="true"] {

          &:focus {
            ~ul {
              left: 0;
            }
          }

          ~ul {

            margin-top: @mobile-menu-back-height;


            &:hover,
            &:focus-within {
              left: 0;
            }

            [aria-haspopup="true"] {
              &:focus {
                ~ul {
                  max-height: 500px;
                  animation: dropdown .3s forwards;
                }
              }
            }

            li {
              &:focus-within {
                >[aria-haspopup="true"] {
                  ~ul {
                    max-height: 500px;
                    transform: scaleY(1);
                  }
                }
              }
            }

          }
        }

        &:focus-within~.mobile-menu-header a {
          visibility: hidden;
        }
      }
    }



    @media (hover: none) {


      .mobile-menu-trigger {
        &:hover {
          ~ul {
            left: 0;
          }
        }
      }


      .menu-bar {
        >li {
          >[aria-haspopup="true"] {
            &:hover {
              ~ul {
                left: 0;
              }
            }

            ~ul {
              &:hover {
                left: 0;
              }

              [aria-haspopup="true"] {
                &:hover {
                  ~ul {
                    max-height: 500px;
                    animation: dropdown .3s forwards;
                  }
                }

                ~ul {
                  &:hover {
                    max-height: 500px;
                    transform: scaleY(1);
                  }
                }
              }
            }
          }

          &:hover~.mobile-menu-header {
            a {
              visibility: hidden;
            }
          }
        }
      }
    }
  }




  @keyframes dropdown {
    0% {
      opacity: 0;
      transform: scaleY(0);
    }

    50% {
      opacity: 1;
    }

    100% {
      transform: scaleY(1);
    }
  }

  @keyframes flyout {
    0% {
      opacity: 0;
      transform: scaleX(0);
    }

    100% {
      opacity: 1;
      transform: scaleX(1);
    }
  }
</style>
<div class="nav">
  <nav>
    <a href="javascript:void(0);" class="mobile-menu-trigger">Open mobile menu</a>
    <ul class="menu menu-bar">
      <li>
        <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">1. Multilevel mega
          menu</a>
        <ul class="mega-menu mega-menu--multiLevel">
          <li>
            <a href="javascript:void(0);" class="menu-link mega-menu-link" aria-haspopup="true">1.1 Flyout
              link</a>
            <ul class="menu menu-list">
              <li>
                <a href="/page" class="menu-link menu-list-link">1.1.1 Page link</a>
              </li>
              <li>
                <a href="javascript:void(0);" class="menu-link menu-list-link" aria-haspopup="true">1.1.2 Flyout
                  link</a>
                <ul class="menu menu-list">
                  <li>
                    <a href="/page" class="menu-link menu-list-link">1.1.2.1 Page link</a>
                  </li>
                  <li>
                    <a href="/page" class="menu-link menu-list-link">1.1.2.2 Page link</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">1.1.3 Page link</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-link mega-menu-link" aria-haspopup="true">1.2 Flyout
              link</a>
            <ul class="menu menu-list">
              <li>
                <a href="/page" class="menu-link menu-list-link">1.2.1 Page link</a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">1.2.2 Page link</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="javascript:void(0);" class="menu-link mega-menu-link" aria-haspopup="true">1.3 Flyout
              link</a>
            <ul class="menu menu-list">
              <li>
                <a href="/page" class="menu-link menu-list-link">1.3.1 Page link</a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">1.3.2 Page link</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="/page" class="menu-link mega-menu-link">1.4 Page link</a>
          </li>
          <li class="mobile-menu-back-item">
            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
          </li>
        </ul>
      </li>

      <li>
        <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">2. Flat mega menu (3
          cols)</a>
        <ul class="mega-menu mega-menu--flat">
          <li>
            <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.1 Page link header</a>
            <ul class="menu menu-list">
              <li>
                <a href="/page" class="menu-link menu-list-link">2.1.1 Page link</a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">2.1.2 Page link</a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">2.1.3 Page link</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.2 Page link header</a>
            <ul class="menu menu-list">
              <li>
                <a href="/page" class="menu-link menu-list-link">2.2.1 Page link</a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">2.2.2 Page link</a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">2.2.3 Page link</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="/page" class="menu-link mega-menu-link mega-menu-header">2.3 Page link header</a>
            <ul class="menu menu-list">
              <li>
                <a href="/page" class="menu-link menu-list-link">2.2.1 Page link</a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">2.2.2 Page link</a>
              </li>
            </ul>
          </li>
          <li class="mobile-menu-back-item">
            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
          </li>
        </ul>
      </li>

      <li>
        <a href="javascript:void(0);" class="menu-link menu-bar-link" aria-haspopup="true">3. Flat mega menu (2
          cols)</a>
        <ul class="mega-menu mega-menu--flat">
          <li>
            <a href="#" class="menu-link mega-menu-link mega-menu-header">3.1 Page link header</a>
            <ul class="menu menu-list">
              <li>
                <a href="/page" class="menu-link menu-list-link">
                  3.1.1 Page link<br />
                  <small>Short decription of link</small>
                </a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">
                  3.1.2 Page link<br />
                  <small>Short decription of link</small>
                </a>
              </li>
              <li>
                <a href="/page" class="menu-link menu-list-link">
                  3.1.2 Page link<br />
                  <small>Short decription of link</small>
                </a>
              </li>
            </ul>
          </li>
          <li class="mega-menu-content">
            <p class="mega-menu-header">3.2 Page link header</p>
            <p>This is just static content. You can add anything here. Images, text, buttons, your grandma's
              secrect
              recipe.</p>
          </li>
          <li class="mobile-menu-back-item">
            <a href="javascript:void(0);" class="menu-link mobile-menu-back-link">Back</a>
          </li>
        </ul>
      </li>

      <li>
        <a href="/page" class="menu-link menu-bar-link">Static link</a>
      </li>

      <li class="mobile-menu-header">
        <a href="/home" class="">
          <span>Home</span>
        </a>
      </li>
    </ul>
  </nav>
</div>