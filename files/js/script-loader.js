/*
* Client-Side Javascript Script Loader
* Created by Lucas Zodiak
*/
Number.prototype.padLeft = function(a, b) {
    var c = String(a || 10).length - String(this).length + 1;
    return c > 0 ? new Array(c).join(b || "0") + this : this
};
var recaptchaLoaded = function() {
	if((typeof Global !== 'undefined') && (Global != null)) {
		if((typeof Global.ReCaptcha !== 'undefined') && (Global.ReCaptcha != null)) {
			Global.ReCaptcha.OnLoad();
		}
	}
}
var ScriptLoader = function() {
    return {
        Global: function() {
            return {
                DateTime: function() {
                    var a = new Date,
                        b = [(a.getMonth() + 1).padLeft(), a.getDate().padLeft(), a.getFullYear()].join("/") + " " + [a.getHours().padLeft(), a.getMinutes().padLeft(), a.getSeconds().padLeft()].join(":");
                    return b
                },
                DateTimeBoxed: function() {
                    return "[" + this.DateTime() + "]"
                },
                GetTimeStamp: function() {
                    return (new Date).getTime()
                },
                GetTimestamp: function() {
                    return this.GetTimeStamp()
                },
                Timestamp: function() {
                    return this.GetTimeStamp()
                },
                CurrentTimestamp: function() {
                    return this.GetTimeStamp()
                },
                timeConversion: function(a) {
                    var b = (a / 1e3).toFixed(1),
                        c = (a / 6e4).toFixed(1),
                        d = (a / 36e5).toFixed(1),
                        e = (a / 864e5).toFixed(1);
                    if (b < 60) {
                        var f = 1 == b ? "" : "s";
                        return b + " Second" + f
                    }
                    if (c < 60) {
                        var g = 1 == c ? "" : "s";
                        return c + " Minute" + g
                    }
                    if (d < 24) {
                        var h = 1 == d ? "" : "s";
                        return d + " Hour" + h
                    }
                    var i = 1 == e ? "" : "s";
                    return e + " Day" + i
                },
                TimeConversion: function(a) {
                    return this.timeConversion(a)
                },
				CurrentURL: (function() {
					return window.location.href;
				})(),
				DoRegisterScripts: (function() {
					return window.location.href.indexOf('/register') !== -1;
				})(),
				LoadRecaptcha: (function() {
					if(window.location.href.indexOf('/register') !== -1)
						return true;
					if(window.location.href.indexOf('/index') !== -1)
						return true;
					return true;
				})(),
				ClearConsole: function() {
					console.log(Array(100).join('\n'));
					try {
						console.clear();
					} catch(ex) {}
				}
            }
        }(),
        Settings: function() {
            return {
				Logger: {
					Enabled: true
				},
				Monitor: {
					IntervalTime: 5000,
					CooldownMilliseconds: 0,
					Started: false,
					CheckingStylesheets: false,
					CheckingScripts: false,
					StylesheetList: [],
					ScriptList: []
				}
            }
        }(),
        Logger: function() {
            return {
                logInfo: function(a) {
					if(ScriptLoader.Settings.Logger.Enabled) {
						"console" in window && ("object" == typeof a ? console.info(a) : console.info("%c " + ScriptLoader.Global.DateTimeBoxed() + " [INFO] - " + a, "background:#000;color:#fff;font-weight:bold;padding:2px;"))
					}
				},
                LogInfo: function(a) {
                    return this.logInfo(a)
                },
                logWarn: function(a) {
					if(ScriptLoader.Settings.Logger.Enabled) {
						"console" in window && ("object" == typeof a ? console.warn(a) : console.warn("%c" + ScriptLoader.Global.DateTimeBoxed() + " [WARN] - " + a, "background:#000;font-weight:bold;padding:2px;color:yellow;"))
					}
				},
                LogWarn: function(a) {
                    return this.logWarn(a)
                },
                logError: function(a) {
					if(ScriptLoader.Settings.Logger.Enabled) {
						"console" in window && ("object" == typeof a ? console.error(a) : console.error("%c" + ScriptLoader.Global.DateTimeBoxed() + " [ERROR] - " + a, "background:#000;font-weight:bold;padding:2px;"))
					}
				},
                LogError: function(a) {
                    return this.logError(a)
                },
				logIntro: function(a) {
					if(ScriptLoader.Settings.Logger.Enabled) {
						"console" in window && ("object" == typeof a ? console.info(a) : console.info("%c " + a, "background:#dd163d;color:white;font-size:15pt;font-weight:bold;padding:2px;"))
					}
				},
                LogIntro: function(a) {
                    return this.logIntro(a)
                },
                logCritical: function(a) {
					if(ScriptLoader.Settings.Logger.Enabled) {
						"console" in window && ("object" == typeof a ? console.log(a) : console.error("%c" + ScriptLoader.Global.DateTimeBoxed() + " [CRITICAL] - " + a, "background:#000;font-weight:bold;font-size:20px;padding:2px;"))
					}
				},
                LogCritical: function(a) {
                    return this.logCritical(a)
                }
            }
        }(),
		Stylesheets: (function() {
			return {
				Reload: function() {
					var queryString = '?reload=' + new Date().getTime();
					$('link[rel="stylesheet"]').each(function () {
						this.href = this.href.replace(/\?.*|$/, queryString);
					});
					
					ScriptLoader.Logger.LogInfo("Stylesheets Reloaded.");
				}
			}
		})(),
		Monitor: (function() {
			return {
				MonitorInterval: null,
				DoMonitor: function() {
					if(ScriptLoader.Settings.Monitor.CooldownMilliseconds >= 1) {
						ScriptLoader.Settings.Monitor.CooldownMilliseconds -= ScriptLoader.Settings.Monitor.IntervalTime;
						if(ScriptLoader.Settings.Monitor.CooldownMilliseconds >= 1) {
							ScriptLoader.Logger.LogInfo("ScriptLoader Monitor is in cooldown mode.");
							return;
						}
					}
					
					ScriptLoader.Logger.LogInfo("ScriptLoader Monitor working.");
					
					ScriptLoader.Monitor.CheckStylesheets();
					
					ScriptLoader.Monitor.CheckScripts();
				},
				Start: function() {
					if(!ScriptLoader.Settings.Monitor.Started) {
						ScriptLoader.Logger.LogInfo("The ScriptLoader Monitor is starting.");
						
						ScriptLoader.Monitor.MonitorInterval = setInterval(ScriptLoader.Monitor.DoMonitor, ScriptLoader.Settings.Monitor.IntervalTime);
						
						ScriptLoader.Logger.LogInfo("The ScriptLoader Monitor has started.");
						ScriptLoader.Settings.Monitor.Started = true;
					}
				},
				Stop: function() {
					if(ScriptLoader.Settings.Monitor.Started) {
						window.clearTimeout(ScriptLoader.Monitor.MonitorInterval);
						
						ScriptLoader.Settings.Monitor.Started = false;
					}
				},
				SetCooldown: function(data) {
					if((typeof data !== 'undefined') && (data != null)) {
						var coolMilliseconds = 0;
						
						if((typeof data.seconds !== 'undefined') && (data.seconds != null)) {
							if((typeof data.seconds === 'number')) {
								coolMilliseconds += Math.floor(data.seconds * 1000);
								ScriptLoader.Settings.Monitor.CooldownMilliseconds = coolMilliseconds;
							}
						}
						
						if((typeof data.minutes !== 'undefined') && (data.minutes != null)) {
							if((typeof data.minutes === 'number')) {
								coolMilliseconds += Math.floor(data.minutes * 60 * 1000);
								ScriptLoader.Settings.Monitor.CooldownMilliseconds = coolMilliseconds;
							}
						}
						
						if((typeof data.hours !== 'undefined') && (data.hours != null)) {
							if((typeof data.hours === 'number')) {
								coolMilliseconds += Math.floor(data.hours * 60 * 60 * 1000);
								ScriptLoader.Settings.Monitor.CooldownMilliseconds = coolMilliseconds;
							}
						}
						
						setTimeout(function() {
							ScriptLoader.Settings.Monitor.CooldownMilliseconds = coolMilliseconds;
						}, 1000);
					}
				},
				RemoveCooldown: function() {
					ScriptLoader.Logger.LogInfo("ScriptLoaded Monitor is leaving cooldown mode.");
					ScriptLoader.Settings.Monitor.CooldownMilliseconds = 0;
				},
				CheckStylesheets: function() {
					$('link').each(function( i ) {
						var queryString = '?reload=' + new Date().getTime();
						var scriptHref = this.href;
						//console.log(scriptHref);
						var currSrc = scriptHref;
						//console.log(currSrc);
						currSrc = currSrc.replace(/\?.*|$/, '');
						//console.log(currSrc);
						var xhr = $.ajax({
						  type: "GET",
						  url: scriptHref + queryString,
						  success: function(msg) {
								var styleLength = xhr.responseText;
								//console.log(styleLength);
								var listItem = ScriptLoader.Settings.Monitor.StylesheetList[currSrc];
								if((typeof listItem !== 'undefined') && (listItem !== null)) {
									if(listItem !== styleLength) {
										ScriptLoader.Settings.Monitor.StylesheetList[currSrc] = styleLength;
										
										ScriptLoader.Stylesheets.Reload();
									}
								} else {
									ScriptLoader.Settings.Monitor.StylesheetList[currSrc] = styleLength;
								}
							}
						});
					});
				}
			}
		})(),
        Loader: function() {
            return {
                loadScript: function(a, b) {
                    if ("undefined" != typeof a && null != a) {
						if((typeof a === 'string')) {
							var c = document.createElement("script");
							c.type = "text/javascript", c.readyState ? c.onreadystatechange = function() {
								"loaded" != c.readyState && "complete" != c.readyState || (c.onreadystatechange = null, "undefined" != typeof b && null != b && "function" == typeof b && b())
							} : c.onload = function() {
								"undefined" != typeof b && null != b && "function" == typeof b && b()
							}, c.src = a, document.getElementsByTagName("head")[0].appendChild(c)
						} else if((typeof a === 'object')) {
							if((typeof a.src !== 'undefined') && (a.src != null)) {
								var c = document.createElement("script");
								c.type = "text/javascript";
								if((typeof a.async !== 'undefined') && (a.async != null)) {
									if(a.async === true) {
										c.async = true;
									}
								}
								if((typeof a.defer !== 'undefined') && (a.defer != null)) {
									if(a.defer === true) {
										c.defer = true;
									}
								}
								c.readyState ? c.onreadystatechange = function() {
									"loaded" != c.readyState && "complete" != c.readyState || (c.onreadystatechange = null, "undefined" != typeof b && null != b && "function" == typeof b && b())
								} : c.onload = function() {
									"undefined" != typeof b && null != b && "function" == typeof b && b()
								}, c.src = a.src, document.getElementsByTagName("head")[0].appendChild(c)
							}
						}
                    }
                },
                LoadScript: function(a, b) {
                    return this.loadScript(a, b)
                },
                FetchScript: function(a, b) {
                    return this.loadScript(a, b)
                }
            }
        }(),
        LoadScripts: function(a) {
            try {
								
				ScriptLoader.Loader.loadScript('files/js/scripts.js', function() {
					ScriptLoader.Logger.LogInfo("Library Callback Timestamp: " + ScriptLoader.Global.GetTimeStamp());											
				});
            } catch (a) {
                ScriptLoader.Logger.LogError("The Script Loader Ran Into An Error:"), ScriptLoader.Logger.LogError(a)
            }
        }
    }
}();
!(function() {
    ScriptLoader.LoadScripts(function() {
        ScriptLoader.Logger.LogInfo("Scripts Finish Timestamp: " + ScriptLoader.Global.GetTimeStamp());
		ScriptLoader.Monitor.Start();
    });
})();