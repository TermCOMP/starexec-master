<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:output method="html" doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN" encoding="UTF-8" doctype-system="http://www.w3.org/TR/html4/loose.dtd"/>
  <xsl:strip-space elements="*"/>

  <xsl:template name="ltsStyles">
    <style type="text/css">
      .atom { display: inline-block; }
      .prevar { color: green; font-style: italic; }
      .postvar { color: brown; font-style: italic; }
      .postvar:after { content: "'"; }
      .error { color: red; }
      .node { color: blue; }
      .sharpnode { color: red; }
      .sharpnode:after { font-size: small; vertical-align: super; content: "#"; }
      .transition:before { font-size: medium; vertical-align: 15%; color: black; content: "&#8594;"; }
      .sharptransition:before { font-size: medium; vertical-align: 15%; color: black; content: "&#8594;"; }
      .transition { font-size: small; vertical-align: -15%; font-style: italic; }
      .sharptransition { font-size: small; vertical-align: -15%; font-style: italic; color: red; }
      .sharptransition:after { font-size: x-small; content: "#"; vertical-align: super; }
    </style>
  </xsl:template>

  <xsl:template match="error">
    <xsl:apply-templates/>
  </xsl:template>

  <xsl:template match="locationId">
    <span class="node">
      <xsl:value-of select="text()"/>
    </span>
  </xsl:template>
  <xsl:template name="locationDuplicate">
    <span class="sharpnode">
      <xsl:value-of select="text()"/>
    </span>
  </xsl:template>
  <xsl:template match="locationDuplicate">
    <xsl:call-template name="locationDuplicate"/>
  </xsl:template>

  <xsl:template match="ltsSafetyInput">
    <xsl:apply-templates select="lts"/>
      Error locations
      <ul>
        <xsl:for-each select="error">
          <li><xsl:apply-templates/></li>
        </xsl:for-each>
      </ul>
  </xsl:template>
  
  <xsl:template match="lts">
    Integer Transition System
    <ul>
      <li>
        Initial Location:
        <xsl:for-each select="initial/*">
          <xsl:if test="position()>1">, </xsl:if>
          <xsl:apply-templates select="."/>
        </xsl:for-each>
      </li>
      <li>
        Transitions: (<span class="prevar">pre-variables</span> and <span class="postvar">post-variables</span>)
        <table>
          <xsl:for-each select="transition">
            <tr style="vertical-align:baseline">
              <td style="text-align:right">
                <xsl:apply-templates select="source"/>
              </td>
              <td style="text-align:left">
                <xsl:apply-templates select="transitionId"/>
              </td>
              <td style="text-align:left">
                <xsl:apply-templates select="target"/>:
              </td>
              <td> </td>
              <td style="text-align:left">
                <xsl:choose>
                  <xsl:when test="formula">
                    <xsl:apply-templates select="formula"/>
                  </xsl:when>
                  <xsl:otherwise>
                    skip
                  </xsl:otherwise>
                </xsl:choose>
              </td>
            </tr>
          </xsl:for-each>
        </table>
      </li>
    </ul>
  </xsl:template>
  
  <xsl:template match="transition">
    <span style="vertical-align: baseline">
      <xsl:apply-templates select="source"/>
      <xsl:text> </xsl:text>
      <xsl:apply-templates select="*[1]"/>
      <xsl:text> </xsl:text>
      <xsl:apply-templates select="target"/>:
      <xsl:choose>
        <xsl:when test="formula">
          <xsl:apply-templates select="formula"/>
        </xsl:when>
        <xsl:otherwise>
          skip
        </xsl:otherwise>
      </xsl:choose>
    </span>
  </xsl:template>

  <xsl:template match="conjunction">
    <xsl:if test="count(*) = 0">
      TRUE
    </xsl:if>
    <xsl:for-each select="*">
      <xsl:if test="position() > 1">
        <xsl:text> &#8743; </xsl:text>
      </xsl:if>
      <xsl:apply-templates select="."/>
    </xsl:for-each>
  </xsl:template>

  <xsl:template match="disjunction">
    <xsl:if test="count(*) = 0">
      FALSE
    </xsl:if>
    <xsl:for-each select="*">
      <xsl:if test="position() > 1">
        <xsl:text> &#8744; </xsl:text>
      </xsl:if>
      <xsl:apply-templates select="."/>
    </xsl:for-each>
  </xsl:template>

  <xsl:template match="leq">
    <span class="atom">
      <xsl:apply-templates select="*[1]"/>
      <xsl:text> &#8804; </xsl:text>
      <xsl:apply-templates select="*[2]"/>
    </span>
  </xsl:template>

  <xsl:template match="less">
    <span class="atom">
      <xsl:apply-templates select="*[1]"/>
      <xsl:text> &lt; </xsl:text>
      <xsl:apply-templates select="*[2]"/>
    </span>
  </xsl:template>
  
  <xsl:template match="eq">
    <span class="atom">
      <xsl:apply-templates select="*[1]"/>
      <xsl:text> = </xsl:text>
      <xsl:apply-templates select="*[2]"/>
    </span>
  </xsl:template>
  
  <xsl:template match="constant">
    <xsl:param name="sgn" select="1"/>
    <xsl:param name="one" select="1"/>
    <xsl:if test="$sgn and text() &lt; 0">&#8722;</xsl:if>
    <xsl:variable name="ac" select="format-number(text(),'0;0')"></xsl:variable>
    <xsl:if test="$one or $ac!='1'">
      <xsl:value-of select="$ac"/>
    </xsl:if>
  </xsl:template>

  <xsl:template match="post">
    <span class="postvar">
      <xsl:value-of select="variableId/text()"/>
    </span>
  </xsl:template>
  <xsl:template match="variableId">
    <xsl:choose>
      <xsl:when test="post">
      </xsl:when>
      <xsl:otherwise>
        <span class="prevar">
          <xsl:value-of select="text()"/>
        </span>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="product">
    <xsl:param name="sgn" select="1"/>
    <xsl:choose>
      <xsl:when test="not(*)">1</xsl:when>
      <xsl:when test="name(*[1]) = 'constant' and (constant[1]/text() = 1 or not($sgn) and constant[1]/text() = -1)">
        <xsl:apply-templates select="*[2]"/>
      </xsl:when>
      <xsl:when test="name(*[1]) = 'constant' and $sgn and constant/text() = -1 and (name(*[2]) = 'post' or name(*[2]) = 'variableId')">
        &#8722;
        <xsl:apply-templates select="*[2]"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:for-each select="*">
          <xsl:if test="position() != 1">&#8901;</xsl:if>
          <xsl:apply-templates select=".">
            <xsl:with-param name="sgn" select="$sgn or position != 1"/>
          </xsl:apply-templates>
        </xsl:for-each>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="sum">
    <xsl:if test="not(node())">
      0
    </xsl:if>
    <xsl:for-each select="*">
      <xsl:choose>
        <xsl:when test="position() = 1">
          <xsl:apply-templates select=".">
            <xsl:with-param name="sgn" select="1"/>
          </xsl:apply-templates>
        </xsl:when>
        <xsl:when test="self::constant and ./text() &lt; 0">
          &#8722;
          <xsl:apply-templates select=".">
            <xsl:with-param name="sgn" select="0"/>
          </xsl:apply-templates>
        </xsl:when>
        <xsl:when test="self::product and local-name(*[1])='constant' and constant/text() &lt; 0">
          &#8722;
          <xsl:apply-templates select=".">
            <xsl:with-param name="sgn" select="0"/>
          </xsl:apply-templates>
        </xsl:when>
        <xsl:otherwise>
          + <xsl:apply-templates select="."/>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:for-each>
  </xsl:template>

  <xsl:template name="position">
    <xsl:choose>
      <xsl:when test="self::conclusion">conclusion</xsl:when>
      <xsl:when test="self::assertion">assertion</xsl:when>
      <xsl:when test="self::transition">transition</xsl:when>
      <xsl:otherwise>???</xsl:otherwise>
    </xsl:choose>
  </xsl:template>
  <xsl:template name="hint">
    <xsl:choose>
      <xsl:when test="self::linearCombination">
        [<xsl:for-each select="*">
          <xsl:if test="position() > 1">, </xsl:if>
          <xsl:apply-templates select="."/>
        </xsl:for-each>]
      </xsl:when>
      <xsl:when test="self::auto">auto</xsl:when>
      <xsl:when test="self::lexStrict">
        lexStrict[<xsl:for-each select="*">
          <xsl:if test="position() > 1">, </xsl:if>
          <xsl:call-template name="hint"/>
        </xsl:for-each>]
      </xsl:when>
      <xsl:when test="self::lexWeak">
        lexWeak[<xsl:for-each select="*">
          <xsl:if test="position() > 1">, </xsl:if>
          <xsl:call-template name="hint"/>
        </xsl:for-each>]
      </xsl:when>
      <xsl:when test="self::distribute">
        distribute <xsl:for-each select="*[1]"><xsl:call-template name="position"/></xsl:for-each>
        <table>
        <xsl:for-each select="*[position()>1]">
          <tr>
            <td> </td>
            <td>
              <xsl:call-template name="hint"/>
            </td>
          </tr></xsl:for-each>
        </table>
      </xsl:when>
      <xsl:when test="self::erase">
        erase <xsl:for-each select="*[1]">
          <xsl:call-template name="position"/>
        </xsl:for-each>,
        <xsl:for-each select="*[2]">
          <xsl:call-template name="hint"/>
        </xsl:for-each>
      </xsl:when>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="impact">
    <xsl:param name="indent"/>
    <h3>
      <xsl:value-of select="$indent"/> IMPACT Invariant Proof
    </h3>
    <ul>
      <li>nodes (location) invariant:
        <table>
          <xsl:for-each select="nodes/node">
            <tr style="vertical-align: baseline;">
              <td style="text-align:right;">
                <xsl:if test="initial[1]">&#8594; </xsl:if>
                <xsl:apply-templates select="nodeId"/>
              </td>
              <td></td>
              <td style="text-align:left;">
                (<xsl:apply-templates select="location"/>)
              </td>
              <td>
                <text> </text>
              </td>
              <td style="text-align:left;">
                <xsl:apply-templates select="invariant"/>
              </td>
            </tr>
          </xsl:for-each>
        </table>
      </li>
      <xsl:if test="initial">
        <li>
          initial node:
          <xsl:apply-templates select="initial"/>
        </li>
      </xsl:if>
      <li>
        cover edges:
        <table>
          <xsl:for-each select="nodes/node/coverEdge">
            <tr style="vertical-align:baseline">
              <td style="text-align:right">
                <xsl:apply-templates select="../*[1]"/>
              </td>
              <td style="text-align:left; white-space: nowrap">
                <xsl:text>&#8594; </xsl:text>
                <xsl:apply-templates select="nodeId"/>
              </td>
              <td>
                <xsl:if test="hints">
                  Hint:
                  <xsl:for-each select="hints/*">
                    <xsl:call-template name="hint"/>
                  </xsl:for-each>
                </xsl:if>
              </td>
            </tr>
          </xsl:for-each>
        </table>
      </li>
      <li>
        transition edges:
        <table>
          <xsl:for-each select="nodes/node/children/child">
            <tr style="vertical-align:baseline">
              <td style="text-align:right">
                <xsl:apply-templates select="../../*[1]"/>
              </td>
              <td style="text-align:left; white-space: nowrap">
                <xsl:apply-templates select="*[1]"/>
                <xsl:text> </xsl:text>
                <xsl:apply-templates select="nodeId"></xsl:apply-templates>
              </td>
              <td>
                <xsl:if test="hints">
                  Hint:
                  <xsl:for-each select="hints/*">
                    <xsl:call-template name="hint"/>
                  </xsl:for-each>
                </xsl:if>
              </td>
            </tr>
          </xsl:for-each>
        </table>
      </li>
    </ul>
  </xsl:template>

  <xsl:template match="transitionId">
    <span class="transition"><xsl:apply-templates/></span>
  </xsl:template>

  <xsl:template match="transitionDuplicate">
    <span class="sharptransition"><xsl:apply-templates/></span>
  </xsl:template>

  <xsl:template name="ltsTerminationProof">
    <xsl:param name="prefix" select="''"/>
    <xsl:param name="index" select="1"/>
    <xsl:variable name="indent" select="concat($prefix, $index)"/>
    <xsl:choose>
      <xsl:when test="self::switchToCooperationTermination">
        <h3>
          <xsl:value-of select="$indent"/> Switch to Cooperation Termination Proof
        </h3>
          We consider the following cutpoint-transitions:
          <table>
            <xsl:for-each select="cutPoints/cutPoint">
              <tr style="vertical-align: baseline">
                <td>
                  <xsl:apply-templates select="locationId"/>
                </td>
                <td>
                  <span class="transition">
                    <xsl:apply-templates select="skipId"/>
                  </span>
                  <xsl:text> </xsl:text>
                </td>
                <td>
                  <xsl:for-each select="locationId">
                    <xsl:call-template name="locationDuplicate"/>
                  </xsl:for-each>
                  <xsl:text>: </xsl:text>
                </td>
                <td>
                  <xsl:choose>
                    <xsl:when test="skipFormula">
                      <xsl:apply-templates select="skipFormula"/>
                    </xsl:when>
                    <xsl:otherwise>
                      SKIP
                    </xsl:otherwise>
                  </xsl:choose>
                </td>
              </tr>
            </xsl:for-each>
          </table>
          and for every transition <span class="transition">t</span>,
          a duplicate <span class="sharptransition">t</span> is considered.
        <xsl:for-each select="*[2]">
            <xsl:call-template name="cooperationProof">
              <xsl:with-param name="prefix" select="$prefix"/>
              <xsl:with-param name="index" select="$index+1"/>
            </xsl:call-template>
        </xsl:for-each>
      </xsl:when>
      <xsl:when test="self::newInvariants">
        <h3>
          <xsl:value-of select="$indent"/> Invariant Updates
        </h3>
        <p>The following invariants are asserted.</p>
        <xsl:apply-templates select="invariants"/>
        <p>The invariants are proved as follows.</p>
        <xsl:apply-templates select="impact">
          <xsl:with-param name="indent" select="''"/>
        </xsl:apply-templates>
        <p></p>
        <xsl:for-each select="*[3]">
          <xsl:call-template name="ltsTerminationProof">
            <xsl:with-param name="prefix" select="$prefix"/>
            <xsl:with-param name="index" select="$index+1"/>
          </xsl:call-template>
        </xsl:for-each>
      </xsl:when>
      <xsl:otherwise>
        <h3>
          <xsl:value-of select="$indent"/> Unknown Termination Proof "<xsl:value-of select="name(.)"/>"!
        </h3>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="ltsTerminationProof">
    <xsl:for-each select="*">
      <xsl:call-template name="ltsTerminationProof">
        <xsl:with-param name="index" select="1"/>
      </xsl:call-template>
    </xsl:for-each>
  </xsl:template>

  <xsl:template name="ltsSafetyProof">
    <xsl:param name="prefix" select="''"/>
    <xsl:param name="index" select="1"/>
    <xsl:variable name="indent" select="concat($prefix, $index)"/>
    <xsl:choose>
      <xsl:when test="self::safetyViaInvariants">
        <h3>
          <xsl:value-of select="$indent"/> Invariant Updates
        </h3>
        <p>The following invariants show that the error locations are unreachable.</p>
        <xsl:apply-templates select="invariants"/>
        <p>The invariants are proved as follows.</p>
        <xsl:apply-templates select="impact">
          <xsl:with-param name="prefix" select="$prefix"/>
          <xsl:with-param name="index" select="$index+1"/>
        </xsl:apply-templates>        
      </xsl:when>
      <xsl:otherwise>
        <h3>
          <xsl:value-of select="$indent"/> Unknown Safety Proof "<xsl:value-of select="name(.)"/>"!
        </h3>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="ltsSafetyProof">
    <xsl:for-each select="*">
      <xsl:call-template name="ltsSafetyProof"/>
    </xsl:for-each>
  </xsl:template>

  <xsl:template name="cooperationProof">
    <xsl:param name="prefix"/>
    <xsl:param name="index" select="1"/>
    <xsl:variable name="indent" select="concat($prefix, $index)"/>
    <xsl:choose>
      <xsl:when test="self::trivial">
        <h3>
          <xsl:value-of select="$indent"/> Trivial Cooperation Program
        </h3>
        <p>
          There are no more "sharp" transitions in the cooperation program.
          Hence the cooperation termination is proved.
        </p>
      </xsl:when>
      <xsl:when test="self::transitionRemoval">
        <h3>
          <xsl:value-of select="$indent"/> Transition Removal
        </h3>
        <xsl:variable name="lex" select="count(bound/*)>1"/>
        <p>
          We remove transition<xsl:if test="count(remove/*)>1">s</xsl:if><xsl:text> </xsl:text>
          <xsl:for-each select="remove/*">
            <xsl:if test="position() > 1">
              <xsl:text>, </xsl:text>
            </xsl:if>
            <xsl:apply-templates select="."/>
          </xsl:for-each>
          using the following <xsl:if test="$lex">lexicographic</xsl:if> ranking functions, which are bounded by
          <xsl:if test="$lex">[</xsl:if>
          <xsl:for-each select="bound/*">
            <xsl:if test="position() > 1">
              <xsl:text>, </xsl:text>
            </xsl:if>
            <xsl:apply-templates select="."/>
          </xsl:for-each>
          <xsl:if test="$lex">]</xsl:if>.
        </p>
        <table>
          <xsl:for-each select="rankingFunctions/rankingFunction">
            <tr style="vertical-align:baseline">
              <td>
                <xsl:apply-templates select="location"/>:
              </td>
              <td>
                <xsl:for-each select="expression">
                  <xsl:if test="$lex">[</xsl:if>
                  <xsl:for-each select="*">
                    <xsl:if test="position() > 1">
                      <xsl:text>, </xsl:text>
                    </xsl:if>
                    <xsl:apply-templates select="."/>
                  </xsl:for-each>
                  <xsl:if test="$lex">]</xsl:if>
                </xsl:for-each>
              </td>
            </tr>
          </xsl:for-each>
        </table>
        <xsl:if test="hints">
          Hints:
          <table>
          <xsl:for-each select="hints/*">
            <tr style="vertical-align:baseline;">
              <td>
                <xsl:apply-templates select="*[1]"/>
              </td>
              <td>
                <xsl:for-each select="*[2]">
                  <xsl:call-template name="hint"/>
                </xsl:for-each>
              </td>
            </tr>
          </xsl:for-each>
        </table>
        </xsl:if>
        <xsl:choose>
          <xsl:when test="hints">
            <xsl:for-each select="*[5]">
              <xsl:call-template name="cooperationProof">
                <xsl:with-param name="prefix" select="$prefix"/>
                <xsl:with-param name="index" select="$index+1"/>
              </xsl:call-template>
            </xsl:for-each>
          </xsl:when>
          <xsl:otherwise>
            <xsl:for-each select="*[4]">
              <xsl:call-template name="cooperationProof">
                <xsl:with-param name="prefix" select="$prefix"/>
                <xsl:with-param name="index" select="$index+1"/>
              </xsl:call-template>
            </xsl:for-each>
          </xsl:otherwise>
        </xsl:choose>
      </xsl:when>
      <xsl:when test="self::newInvariants">
        <h3>
          <xsl:value-of select="$indent"/> Invariant Updates
        </h3>
        <p>The following invariants are asserted.</p>
        <xsl:apply-templates select="invariants"/>
        <p>The invariants are proved as follows.</p>
        <xsl:apply-templates select="impact">
          <xsl:with-param name="indent" select="''"/>
        </xsl:apply-templates>
        <p></p>
        <xsl:for-each select="*[3]">
            <xsl:call-template name="cooperationProof">
              <xsl:with-param name="prefix" select="$prefix"/>
              <xsl:with-param name="index" select="$index+1"/>
            </xsl:call-template>
        </xsl:for-each>
      </xsl:when>
      <xsl:when test="self::locationAddition">
        <h3>
          <xsl:value-of select="$indent"/> Location Addition
        </h3>
        <p>
          The following skip-transition is inserted and corresponding redirections w.r.t. the old location are performed. 
        </p>
        <p>
          <xsl:apply-templates select="transition"/>
        </p>
        <xsl:for-each select="*[2]">
          <xsl:call-template name="cooperationProof">
            <xsl:with-param name="prefix" select="$prefix"/>
            <xsl:with-param name="index" select="$index+1"/>
          </xsl:call-template>
        </xsl:for-each>
      </xsl:when>
      <xsl:when test="self::freshVariableAddition">
        <h3>
          <xsl:value-of select="$indent"/> Fresh Variable Addition
        </h3>
        <p>
        The new variable <xsl:apply-templates select="*[1]"/> is introduced.
        The transition formulas are extended as follows:
        <table>
          <xsl:for-each select="additionalFormulas/additionalFormula">
            <tr><td><xsl:apply-templates select="*[1]"/>: </td><td><xsl:apply-templates select="*[2]"/></td></tr>
          </xsl:for-each>
        </table>
        </p>
          <xsl:for-each select="*[4]">
            <xsl:call-template name="cooperationProof">
              <xsl:with-param name="prefix" select="$prefix"/>
              <xsl:with-param name="index" select="$index+1"/>
            </xsl:call-template>
          </xsl:for-each>
        
      </xsl:when>
      <xsl:when test="self::sccDecomposition">
        <h3>
          <xsl:value-of select="$indent"/> SCC Decomposition 
        </h3>
        <p>
          <xsl:variable name="cnt" select="count(sccWithProof)"/>
          <xsl:choose>
            <xsl:when test="$cnt=0">
              There exist no SCC in the program graph.
            </xsl:when>
            <xsl:otherwise>
              We consider subproblems for each of the <xsl:value-of select="$cnt"/> SCC(s) of the program graph.
              <xsl:for-each select="sccWithProof">
                <xsl:variable name="newindent" select="concat($indent,'.',position())"/>
                <h3>
                  <xsl:value-of select="$newindent"/> SCC Subproblem <xsl:value-of select="position()"/>/<xsl:value-of select="$cnt"/>
                </h3>
                <p>Here we consider the SCC
                  <xsl:text>{ </xsl:text>
                  <xsl:for-each select="scc/*">
                    <xsl:if test="position() != 1">, </xsl:if>
                    <xsl:apply-templates select="."/>
                  </xsl:for-each>
                  <xsl:text> }.</xsl:text>
                </p>
                <xsl:for-each select="*[2]">
                  <xsl:call-template name="cooperationProof">
                    <xsl:with-param name="prefix" select="concat($newindent,'.')"/>
                  </xsl:call-template>
                </xsl:for-each>
              </xsl:for-each>
            </xsl:otherwise>
          </xsl:choose>
        </p>        
      </xsl:when>
      <xsl:when test="self::cutTransitionSplit">
        <h3>
          <xsl:value-of select="$indent"/> Splitting Cut-Point Transitions 
        </h3>
        <p>
          <xsl:variable name="cnt" select="count(cutTransitionsWithProof)"/>
          <xsl:choose>
            <xsl:when test="$cnt=0">
              There remain no cut-point transition to consider. Hence the cooperation termination is trivial.
            </xsl:when>
            <xsl:otherwise>
              We consider <xsl:value-of select="$cnt"/> subproblems corresponding to sets of cut-point transitions as follows.
            <xsl:for-each select="cutTransitionsWithProof">
                <xsl:variable name="newindent" select="concat($indent, '.', position())"/>
                <h3>
                  <xsl:value-of select="$newindent"/> Cut-Point Subproblem <xsl:value-of select="position()"/>/<xsl:value-of select="$cnt"/>
                </h3>
                Here we consider cut-point transition<xsl:if test="count(cutTransitions/*)>1">s</xsl:if>
                <xsl:text> </xsl:text>
                <xsl:for-each select="cutTransitions/*">
                  <xsl:if test="position() != 1">, </xsl:if>
                  <xsl:apply-templates select="."/>
                </xsl:for-each>
                <xsl:text>.</xsl:text>
                <xsl:for-each select="*[2]">
                  <xsl:call-template name="cooperationProof">
                    <xsl:with-param name="prefix" select="concat($newindent,'.')"/>
                  </xsl:call-template>
                </xsl:for-each>
              </xsl:for-each>
            </xsl:otherwise>
          </xsl:choose>
        </p>        
      </xsl:when>
      <xsl:otherwise>
        <h3>
          <xsl:value-of select="$indent"/> Unknown Cooperation Proof "<xsl:value-of select="name(.)"/>"!
        </h3>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template match="invariants">
    <table>
      <xsl:for-each select="invariant">
        <tr style="vertical-align:baseline">
          <td>
            <xsl:apply-templates select="location"/>:
          </td>
          <td>
            <xsl:apply-templates select="formula"/>
          </td>
        </tr>
      </xsl:for-each>
    </table>
  </xsl:template>

</xsl:stylesheet>