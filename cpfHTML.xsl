<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html" doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN" encoding="UTF-8" doctype-system="http://www.w3.org/TR/html4/loose.dtd"/>
    <xsl:strip-space elements="*"/>
  <xsl:include href="lts.xsl"/>
    <!-- TO ADAPT / INTEGRATE
      - handling of assumptions
      - better output for split / splitProc
    -->

    <xsl:variable name="approx">&#8776;</xsl:variable>
    <xsl:variable name="cdot">&#183;</xsl:variable>
    <xsl:variable name="arrow">&#8594;</xsl:variable>
    <xsl:variable name="rewrite"> &#8594; </xsl:variable>
    <xsl:variable name="rewriteRev"> &#8592; </xsl:variable>
    <xsl:variable name="epsilon">&#949;</xsl:variable>
    <xsl:variable name="sigma">&#963;</xsl:variable>
    <xsl:variable name="pi">&#960;</xsl:variable>
    <xsl:variable name="mu">&#956;</xsl:variable>
    <xsl:variable name="infty">&#8734;</xsl:variable>
    <xsl:variable name="emptyset">&#8709;</xsl:variable>
    <xsl:variable name="forall">&#8704;</xsl:variable>
    <xsl:variable name="ge">&#8805;</xsl:variable>
    <xsl:variable name="gege">&#187;</xsl:variable>
    <xsl:variable name="box">&#9744;</xsl:variable>
    <xsl:variable name="implication">&#10233;</xsl:variable>
    <xsl:variable name="mapsto"> &#8614; </xsl:variable>
    <xsl:variable name="union"> &#8746; </xsl:variable>
                    
    <xsl:template match="/certificationProblem">
        <xsl:variable name="mode">
            <xsl:choose>
                <xsl:when test="proof/trsTerminationProof">TRS Termination Proof</xsl:when>
                <xsl:when test="proof/acTerminationProof">AC Termination Proof</xsl:when>
                <xsl:when test="proof/trsNonterminationProof">Nontermination Proof</xsl:when>
                <xsl:when test="proof/dpProof">Finiteness Proof</xsl:when>
                <xsl:when test="proof/crProof">Confluence Proof</xsl:when>
                <xsl:when test="proof/crDisproof">Non-Confluence Proof</xsl:when>
                <xsl:when test="proof/completionProof">Completion Proof</xsl:when>
                <xsl:when test="proof/orderedCompletionProof">Ordered Completion Proof</xsl:when>
                <xsl:when test="proof/equationalProof">Equational Reasoning Proof</xsl:when>
                <xsl:when test="proof/equationalDisproof">Equational Reasoning Disproof</xsl:when>
                <xsl:when test="proof/dpNonterminationProof">Infiniteness Proof</xsl:when>
                <xsl:when test="proof/relativeTerminationProof">Relative Termination Proof</xsl:when>
                <xsl:when test="proof/relativeNonterminationProof">Relative Nontermination Proof</xsl:when>
                <xsl:when test="proof/complexityProof">Complexity Proof</xsl:when>
                <xsl:when test="proof/quasiReductiveProof">Quasi Reductive Proof</xsl:when>
                <xsl:when test="proof/conditionalCrProof">Confluence Proof for Conditional TRS</xsl:when>
                <xsl:when test="proof/conditionalCrDisproof">Non-Confluence Proof for Conditional TRS</xsl:when>
                <xsl:when test="proof/treeAutomatonClosedProof">Automaton which is Closed under Rewriting</xsl:when>
                <xsl:when test="proof/infeasibilityProof">Infeasibility Proof</xsl:when>
                <xsl:when test="proof/nonreachabilityProof">Non-Reachability Proof</xsl:when>
                <xsl:when test="proof/nonjoinabilityProof">Non-Joinability Proof</xsl:when>
                <xsl:when test="proof/ltsTerminationProof">LTS Termination Proof</xsl:when>
                <xsl:when test="proof/ltsSafetyProof">LTS Safety Proof</xsl:when>
                <xsl:when test="proof/unknownInputProof">Proof for unsupported input</xsl:when>
                <xsl:otherwise><xsl:message terminate="yes">unknown proof type</xsl:message></xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <html>
            <head>
                <title>
                    <xsl:value-of select="$mode"/>
                </title>
                <style type="text/css">
                  * { font-family: "Times New Roman", Times, serif; }
                  .dp_fun { color: darkgreen; }
                  .error { color: red; }
                  .fun { color: darkblue; }
                  .label { color: gray; }
                  .var { color: red; }
                  table.matrix { margin: auto; } 
                  .matrix td {
                  text-align: center;
                  line-height: 1.2em;
                  padding: 0 1ex 0ex 1ex;
                  }                  
                  table.matrixbrak { display: inline-table; vertical-align: middle;}
                  td.lbrak { width: 0.8ex;
                  font-size: 50%;
                  border: solid thin black;
                  border-right: none;
                  }
                  td.rbrak { width: 0.8ex; 
                  font-size: 50%;
                  border: solid thin black;
                  border-left: none;
                  }
                  .matrixbrak td { line-height: 1.4; }                                                        
                </style>
                <xsl:call-template name="ltsStyles"/>
            </head>
            <body>
                <h1>
                    <xsl:value-of select="$mode"/>                    
                </h1>
                <xsl:apply-templates select="origin/proofOrigin"/>
                <xsl:call-template name="inputOrigin"/>
                <xsl:apply-templates select="input"/>
                
                <h2>Proof</h2>
                    <xsl:apply-templates select="proof/*">
                        <xsl:with-param name="indent" select="1"/>
                    </xsl:apply-templates>
                <xsl:apply-templates select="origin/proofOrigin" mode="toolConfiguration"/>
            </body>
        </html>
    </xsl:template>
    
    <xsl:template match="proofOrigin">
        <p>
            <xsl:text>by </xsl:text>
            <xsl:for-each select="tool">
                <xsl:if test="position() != 1">, </xsl:if>
                <xsl:call-template name="toolName"/>
            </xsl:for-each>            
        </p>
    </xsl:template>
    
    <xsl:template name="toolName">
        <xsl:choose>
            <xsl:when test="url">
                <xsl:element name="a">
                    <xsl:attribute name="href">
                        <xsl:value-of select="normalize-space(url/text())"/>
                    </xsl:attribute>
                    <xsl:value-of select="name/text()"/>
                </xsl:element>
            </xsl:when>
            <xsl:otherwise>
                <xsl:value-of select="name/text()"/>
            </xsl:otherwise>
        </xsl:choose>        
    </xsl:template>
    
    <xsl:template match="proofOrigin" mode="toolConfiguration">
        <h2>Tool configuration</h2>
        <xsl:for-each select="tool">
            <p>
                <xsl:call-template name="toolName"/>
                <ul>
                    <li>version: <xsl:apply-templates select="version"/></li>
                    <xsl:if test="strategy">
                        <li>strategy:                         
                        <xsl:apply-templates select="strategy/text()"/>
                        </li>
                    </xsl:if>                                    
                </ul>
            </p>
        </xsl:for-each>                    
    </xsl:template>
    
    
    <xsl:template name="inputOrigin">
        <h2>
            <xsl:text>Input</xsl:text>
            <xsl:apply-templates select="origin/inputOrigin"/>
        </h2>
    </xsl:template>
    
    <xsl:template match="inputOrigin">
        <xsl:if test="count(*) != 0">: </xsl:if>
        <xsl:apply-templates select="tpdbReference"/>
        <xsl:if test="count(*) = 2"> / </xsl:if>
        <xsl:apply-templates select="source"/>
    </xsl:template>
    
    <xsl:template match="tpdbReference">
        <xsl:choose>
            <xsl:when test="tpdbId">
                <xsl:element name="a">
                    <xsl:attribute name="href">
                        <xsl:text>http://termcomp.uibk.ac.at/termcomp/tpdb/tpviewer.seam?tpId=</xsl:text>
                        <xsl:apply-templates select="tpdbId"/>
                    </xsl:attribute>
                    <xsl:apply-templates select="fileName"/>
                </xsl:element>
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="fileName"/>
            </xsl:otherwise>
        </xsl:choose>        
    </xsl:template>
    
    <xsl:template match="equationalProof">
        <xsl:param name="indent"/>
        <xsl:choose>
            <xsl:when test="subsumptionProof">
                <xsl:apply-templates select="*" mode="conversion">
                    <xsl:with-param name="indent" select="$indent"/>
                </xsl:apply-templates>                
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="*">
                    <xsl:with-param name="indent" select="$indent"/>
                </xsl:apply-templates>
                
            </xsl:otherwise>
        </xsl:choose>        
    </xsl:template>

    <xsl:template match="unknownInputProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="complexityProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*" mode="complexity">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="equationalDisproof">
        <xsl:param name="indent"/>
        <xsl:choose>
            <xsl:when test="convertibleInstance">
                <xsl:apply-templates select="current()" mode="conversion">
                    <xsl:with-param name="indent" select="$indent"/>
                </xsl:apply-templates>                
            </xsl:when>
            <xsl:when test="orderedCompletion">
                <xsl:apply-templates select="current()" mode="conversion">
                    <xsl:with-param name="indent" select="$indent"/>
                </xsl:apply-templates>                
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="*" mode="neq">
                    <xsl:with-param name="indent" select="$indent"/>
                </xsl:apply-templates>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    <xsl:template match="convertibleInstance" mode="conversion">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/>Convertible Instance Proof</h3>
        We provide a series of conversions that follow from the set of equations. Each conversion may be used in upcoming
        conversions, and an instance of the negated goal is contained in the conversions.
        <ul><li>
            <xsl:apply-templates select=".">
                <xsl:with-param name="rules">conversions</xsl:with-param>
            </xsl:apply-templates>
        </li></ul>
    </xsl:template>

    <xsl:template match="orderedCompletion">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="." mode="conversion">
          <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="orderedCompletion" mode="conversion">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Disproof via Ordered Completion</h3>
        <p>
          Ordered completion is applied to E<sub>0</sub>, resulting
          in a ground complete system. The goal equation is ground and
          its two terms have different normal forms in the resulting system.
        </p>
        <xsl:apply-templates select="orderedCompletionResult"/>
        
        <xsl:apply-templates select="orderedCompletionProof"/>
    </xsl:template>
    
    <xsl:template match="trsTerminationProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="acTerminationProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="acDPTerminationProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="quasiReductiveProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>    
    
    <xsl:template match="treeAutomatonClosedProof">
        <xsl:apply-templates select="criterion"/>
    </xsl:template> 

    <xsl:template match="conditionalCrProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*" mode="cr">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>    

    <xsl:template match="conditionalCrDisproof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*" mode="ncr">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>    
    
    <xsl:template match="crProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="crDisproof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="wcrAndSN">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Locally confluent and terminating</h3>
        Confluence is proven by showing local confluence and termination.
        <xsl:apply-templates select="./trsTerminationProof">
            <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
        <xsl:apply-templates select="wcrProof">
            <xsl:with-param name="indent" select="concat($indent,'.2')"/>
        </xsl:apply-templates>
    </xsl:template>    

    <xsl:template match="modularityDisjoint">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Modularity of confluence for disjoint unions</h3>
        The TRS can be decomposed as a disjoint union of R union S where R is the following 
        nonconfluent TRS. 
        <xsl:apply-templates select="trs"/>
        <xsl:apply-templates select="crDisproof">
            <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
    </xsl:template>    
    
    <xsl:template match="nonWcrAndSN">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Not locally confluent and terminating</h3>
        (Non-)Confluence is decidable since the TRS is terminating.
        <xsl:apply-templates select="./trsTerminationProof">
            <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
    </xsl:template>    

    <xsl:template match="al94" mode="cr">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Quasi-reductive SDTRS where all CCPs are joinable</h3>
      The given strongly deterministic oriented 3-CTRS is quasi-reductive and all CCPs are joinable.
      <h3><xsl:value-of select="concat($indent, '.1')"/> Quasi-Reductive CTRS</h3>
      The given CTRS is quasi-reductive
      <xsl:apply-templates select="./quasiReductiveProof">
        <xsl:with-param name="indent" select="concat($indent, '.1.1')"/>
      </xsl:apply-templates>
      <h3><xsl:value-of select="concat($indent, '.2')"/> All CCPs are joinable</h3>
      A CCP is joinable if it is context-joinable, infeasible, or unfeasible.
      <xsl:apply-templates select="./contextJoinableCCPs">
        <xsl:with-param name="indent" select="concat($indent, '.2')"/>
      </xsl:apply-templates>
      <xsl:apply-templates select="./infeasibleConditions">
        <xsl:with-param name="indent" select="concat($indent, '.2')"/>
      </xsl:apply-templates>
      <xsl:apply-templates select="./unfeasibleCCPs">
        <xsl:with-param name="indent" select="concat($indent, '.2')"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template name="inlineConditions">
      <xsl:param name="indent"/>
      <xsl:param name="proof"/>
      <h3><xsl:value-of select="$indent"/> Inlining of Conditions</h3>
      Inlining of conditions results in the following transformed CTRS having the
      same multistep rewrite relation.
      <xsl:apply-templates select="./rules"/>
      <xsl:apply-templates select="$proof">
        <xsl:with-param name="indent" select="concat($indent, '.1')"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="inlineConditions" mode="cr">
      <xsl:param name="indent"/>
      <xsl:call-template name="inlineConditions">
        <xsl:with-param name="indent" select="$indent"/>
        <xsl:with-param name="proof" select="./conditionalCrProof"/>
      </xsl:call-template>
    </xsl:template>

    <xsl:template match="inlineConditions" mode="ncr">
      <xsl:param name="indent"/>
      <xsl:call-template name="inlineConditions">
        <xsl:with-param name="indent" select="$indent"/>
        <xsl:with-param name="proof" select="./conditionalCrDisproof"/>
      </xsl:call-template>
    </xsl:template>

    <xsl:template name="infeasibleRuleRemoval">
      <xsl:param name="indent"/>
      <xsl:param name="proof"/>
      <h3><xsl:value-of select="$indent"/> Removal of Infeasible Rules</h3>
      We may safely remove rules with infeasible conditions. They do not
      influence the rewrite relation in any way.
      <h3><xsl:value-of select="concat($indent, '.1')"/> Rules with Infeasible Conditions</h3>
      <xsl:apply-templates select="infeasibleRules">
        <xsl:with-param name="indent" select="concat($indent, '.1')"/>
      </xsl:apply-templates>
      <xsl:apply-templates select="$proof">
        <xsl:with-param name="indent" select="concat($indent, '.2')"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="infeasibleRuleRemoval" mode="cr">
      <xsl:param name="indent"/>
      <xsl:call-template name="infeasibleRuleRemoval">
        <xsl:with-param name="indent" select="$indent"/>
        <xsl:with-param name="proof" select="./conditionalCrProof"/>
      </xsl:call-template>
    </xsl:template>

    <xsl:template match="infeasibleRuleRemoval" mode="ncr">
      <xsl:param name="indent"/>
      <xsl:call-template name="infeasibleRuleRemoval">
        <xsl:with-param name="indent" select="$indent"/>
        <xsl:with-param name="proof" select="./conditionalCrDisproof"/>
      </xsl:call-template>
    </xsl:template>

    <xsl:template name="unconditional">
      <xsl:param name="indent"/>
      <xsl:param name="proof"/>
      <h3><xsl:value-of select="$indent"/> CTRS without Conditions</h3>
      Switching from confluence of a CTRS without conditions to confluence
      of the corresponding TRS.
      <xsl:apply-templates select="$proof">
        <xsl:with-param name="indent" select="concat($indent, '.1')"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="unconditional" mode="cr">
      <xsl:param name="indent"/>
      <xsl:call-template name="unconditional">
        <xsl:with-param name="indent" select="$indent"/>
        <xsl:with-param name="proof" select="./crProof"/>
      </xsl:call-template>
    </xsl:template>

    <xsl:template match="unconditional" mode="ncr">
      <xsl:param name="indent"/>
      <xsl:call-template name="unconditional">
        <xsl:with-param name="indent" select="$indent"/>
        <xsl:with-param name="proof" select="./crDisproof"/>
      </xsl:call-template>
    </xsl:template>

    <xsl:template match="almostOrthogonalModuloInfeasibility" mode="cr">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Almost-orthogonal modulo infeasibility</h3>
      The given (extended) properly oriented, right-stable, oriented 3-CTRS
      is almost-orthogonal modulo infeasibility,
      since all its conditional critical pairs are infeasible.
      <xsl:apply-templates select="./aoInfeasibleConditions">
        <xsl:with-param name="indent" select="$indent"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="almostOrthogonal" mode="cr">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Almost-orthogonal</h3>
      The given (extended) properly oriented, right-stable, oriented 3-CTRS
      is almost-orthogonal,
      since there are no conditional critical pairs.
    </xsl:template>

    <xsl:template match="aoInfeasibleConditions">
      <xsl:param name="indent"/>
      <xsl:variable name="all" select="count(aoInfeasibleCondition)"/>
      <!--<h3><xsl:value-of select="$indent"/> Infeasible Conditional Critical Pairs</h3>
      <p>All <xsl:value-of select="$all"/> CCPs can be shown to be infeasible.</p>-->
      <xsl:choose>
        <xsl:when test="$all &gt; 0">
          <ul>
            <xsl:apply-templates select="." mode="iterate">
              <xsl:with-param name="count" select="1"/>
              <xsl:with-param name="indent" select="$indent"/>
              <xsl:with-param name="index" select="1"/>
              <xsl:with-param name="n" select="$all"/>
            </xsl:apply-templates>
          </ul>
        </xsl:when>
      </xsl:choose>
    </xsl:template>

    <xsl:template match="infeasibleConditions">
      <xsl:param name="indent"/>
      <xsl:variable name="all" select="count(infeasibleCondition)"/>
      <xsl:choose>
        <xsl:when test="$all &gt; 0">
          <ul>
            <xsl:apply-templates select="." mode="iterate">
              <xsl:with-param name="count" select="1"/>
              <xsl:with-param name="indent" select="$indent"/>
              <xsl:with-param name="index" select="1"/>
              <xsl:with-param name="n" select="$all"/>
            </xsl:apply-templates>
          </ul>
        </xsl:when>
      </xsl:choose>
    </xsl:template>

    <xsl:template match="infeasibleRules">
      <xsl:param name="indent"/>
      <xsl:variable name="all" select="count(infeasibleRule)"/>
      <xsl:choose>
        <xsl:when test="$all &gt; 0">
          <ul>
            <xsl:apply-templates select="." mode="iterate">
              <xsl:with-param name="count" select="1"/>
              <xsl:with-param name="indent" select="$indent"/>
              <xsl:with-param name="index" select="1"/>
              <xsl:with-param name="n" select="$all"/>
            </xsl:apply-templates>
          </ul>
        </xsl:when>
      </xsl:choose>
    </xsl:template>

    <xsl:template match="contextJoinableCCPs">
      <xsl:param name="indent"/>
      <xsl:variable name="all" select="count(contextJoinableCCP)"/>
      <xsl:choose>
        <xsl:when test="$all &gt; 0">
          <ul>
            <xsl:apply-templates select="." mode="iterate">
              <xsl:with-param name="count" select="1"/>
              <xsl:with-param name="indent" select="$indent"/>
              <xsl:with-param name="index" select="1"/>
              <xsl:with-param name="n" select="$all"/>
            </xsl:apply-templates>
          </ul>
        </xsl:when>
      </xsl:choose>
    </xsl:template>

    <xsl:template match="unfeasibleCCPs">
      <xsl:param name="indent"/>
      <xsl:variable name="all" select="count(unfeasibleCCP)"/>
      <xsl:choose>
        <xsl:when test="$all &gt; 0">
          <ul>
            <xsl:apply-templates select="." mode="iterate">
              <xsl:with-param name="count" select="1"/>
              <xsl:with-param name="indent" select="$indent"/>
              <xsl:with-param name="index" select="1"/>
              <xsl:with-param name="n" select="$all"/>
            </xsl:apply-templates>
          </ul>
        </xsl:when>
      </xsl:choose>
    </xsl:template>

    <xsl:template name="condition">
      <xsl:apply-templates select="lhs"/>
      <xsl:text> </xsl:text>
      <xsl:value-of select="$approx"/>
      <xsl:text> </xsl:text>
      <xsl:apply-templates select="rhs"/>
    </xsl:template>

    <xsl:template name="conditions">
      <xsl:for-each select="condition">
        <xsl:if test="position() &gt; 1">
          <xsl:text>, </xsl:text>
        </xsl:if>
        <xsl:call-template name="condition"/>
      </xsl:for-each>
    </xsl:template>

    <xsl:template mode="iterate" match="aoInfeasibleConditions">
      <xsl:param name="indent"/>
      <xsl:param name="count"/>
      <xsl:param name="index"/>
      <xsl:param name="n"/>
      <xsl:variable name="newindex" select="$index + count(aoInfeasibleCondition[$count])"/>
      <xsl:if test="$index != $newindex">
        <xsl:variable name="num" select="$index"/>
        <li>
          The
          <xsl:choose>
            <xsl:when test="$num mod 10 = 1 and $num != 11"><xsl:value-of select="$num"/><sup>st</sup></xsl:when>
            <xsl:when test="$num mod 10 = 2 and $num != 12"><xsl:value-of select="$num"/><sup>nd</sup></xsl:when>
            <xsl:when test="$num mod 10 = 3 and $num != 13"><xsl:value-of select="$num"/><sup>rd</sup></xsl:when>
            <xsl:otherwise><xsl:value-of select="$num"/><sup>th</sup></xsl:otherwise>
          </xsl:choose>
          CCP contains
          <xsl:choose>
            <xsl:when test="count(aoInfeasibleCondition[$count]/conditions[1]/condition) = 0">no conditions</xsl:when>
            <xsl:otherwise>
              the condition<xsl:if test="count(aoInfeasibleCondition[$count]/conditions[1]/condition) &gt; 1">s</xsl:if>
              <xsl:text> </xsl:text>
              <xsl:for-each select="aoInfeasibleCondition[$count]/conditions[1]">
                <xsl:call-template name="conditions"/>
              </xsl:for-each>
            </xsl:otherwise>
          </xsl:choose>
          from the first rule
          and
          <xsl:choose>
            <xsl:when test="count(aoInfeasibleCondition[$count]/conditions[2]/condition) = 0">no conditions</xsl:when>
            <xsl:otherwise>
              the condition<xsl:if test="count(aoInfeasibleCondition[$count]/conditions[2]/condition) &gt; 1">s</xsl:if>
              <xsl:text> </xsl:text>
              <xsl:for-each select="aoInfeasibleCondition[$count]/conditions[2]">
                <xsl:call-template name="conditions"/>
              </xsl:for-each>
            </xsl:otherwise>
          </xsl:choose>

          from the second rule.

          <xsl:apply-templates select="aoInfeasibleCondition[$count]/*[3]">
            <xsl:with-param name="indent" select="concat($indent, '.', $index)"/>
          </xsl:apply-templates>
          <br/>
          <br/>
        </li>
      </xsl:if>
      <xsl:if test="$count &lt; $n">
        <xsl:apply-templates select="." mode="iterate">
          <xsl:with-param name="indent" select="$indent"/>
          <xsl:with-param name="count" select="$count + 1"/>
          <xsl:with-param name="index" select="$newindex"/>
          <xsl:with-param name="n" select="$n"/>
        </xsl:apply-templates>
      </xsl:if>
    </xsl:template>

    <xsl:template mode="iterate" match="contextJoinableCCPs">
      <xsl:param name="indent"/>
      <xsl:param name="count"/>
      <xsl:param name="index"/>
      <xsl:param name="n"/>
      <xsl:variable name="newindex" select="$index + count(contextJoinableCCP[$count])"/>
      <xsl:if test="$index != $newindex">
        <xsl:variable name="num" select="$index"/>
        <li>
          The
          <xsl:choose>
            <xsl:when test="$num mod 10 = 1 and $num != 11"><xsl:value-of select="$num"/><sup>st</sup></xsl:when>
            <xsl:when test="$num mod 10 = 2 and $num != 12"><xsl:value-of select="$num"/><sup>nd</sup></xsl:when>
            <xsl:when test="$num mod 10 = 3 and $num != 13"><xsl:value-of select="$num"/><sup>rd</sup></xsl:when>
            <xsl:otherwise><xsl:value-of select="$num"/><sup>th</sup></xsl:otherwise>
          </xsl:choose>
          CCP
          <xsl:apply-templates select="contextJoinableCCP[$count]/*[1]"/>
          =
          <xsl:apply-templates select="contextJoinableCCP[$count]/*[2]"/>
          <xsl:choose>
            <xsl:when test="count(contextJoinableCCP[$count]/conditions/condition) = 0"/>
            <xsl:otherwise>
              <xsl:text> | </xsl:text>
              <xsl:apply-templates select="contextJoinableCCP[$count]/conditions"/>
            </xsl:otherwise>
          </xsl:choose>

          is context-joinable.

          <br/>
          <br/>
        </li>
      </xsl:if>
      <xsl:if test="$count &lt; $n">
        <xsl:apply-templates select="." mode="iterate">
          <xsl:with-param name="indent" select="$indent"/>
          <xsl:with-param name="count" select="$count + 1"/>
          <xsl:with-param name="index" select="$newindex"/>
          <xsl:with-param name="n" select="$n"/>
        </xsl:apply-templates>
      </xsl:if>
    </xsl:template>
    
    <xsl:template mode="iterate" match="infeasibleConditions">
      <xsl:param name="indent"/>
      <xsl:param name="count"/>
      <xsl:param name="index"/>
      <xsl:param name="n"/>
      <xsl:variable name="newindex" select="$index + count(infeasibleCondition[$count])"/>
      <xsl:if test="$index != $newindex">
        <xsl:variable name="num" select="$index + count(../contextJoinableCCPs/contextJoinableCCP)"/>
        <li>
          The
          <xsl:choose>
            <xsl:when test="$num mod 10 = 1 and $num != 11"><xsl:value-of select="$num"/><sup>st</sup></xsl:when>
            <xsl:when test="$num mod 10 = 2 and $num != 12"><xsl:value-of select="$num"/><sup>nd</sup></xsl:when>
            <xsl:when test="$num mod 10 = 3 and $num != 13"><xsl:value-of select="$num"/><sup>rd</sup></xsl:when>
            <xsl:otherwise><xsl:value-of select="$num"/><sup>th</sup></xsl:otherwise>
          </xsl:choose>
          CCP contains
          <xsl:choose>
            <xsl:when test="count(infeasibleCondition[$count]/conditions/condition) = 0">no conditions</xsl:when>
            <xsl:otherwise>
              the condition<xsl:if test="count(infeasibleCondition[$count]/conditions/condition) &gt; 1">s</xsl:if>
              <xsl:text> </xsl:text>
              <xsl:for-each select="infeasibleCondition[$count]/conditions[1]">
                <xsl:call-template name="conditions"/>
              </xsl:for-each>
            </xsl:otherwise>
          </xsl:choose>

          <xsl:apply-templates select="infeasibleCondition[$count]/*[2]">
            <xsl:with-param name="indent" select="concat($indent, '.', $index)"/>
          </xsl:apply-templates>
          <br/>
          <br/>
        </li>
      </xsl:if>
      <xsl:if test="$count &lt; $n">
        <xsl:apply-templates select="." mode="iterate">
          <xsl:with-param name="indent" select="$indent"/>
          <xsl:with-param name="count" select="$count + 1"/>
          <xsl:with-param name="index" select="$newindex"/>
          <xsl:with-param name="n" select="$n"/>
        </xsl:apply-templates>
      </xsl:if>
    </xsl:template>

    <xsl:template mode="iterate" match="infeasibleRules">
      <xsl:param name="indent"/>
      <xsl:param name="count"/>
      <xsl:param name="index"/>
      <xsl:param name="n"/>
      <xsl:variable name="newindex" select="$index + count(infeasibleRule[$count])"/>
      <xsl:if test="$index != $newindex">
        <xsl:variable name="num" select="$index"/>
        <li>
          <xsl:apply-templates mode="iterate" select="infeasibleRule[$count]">
            <xsl:with-param name="indent" select="concat($indent, '.', $index)"/>
          </xsl:apply-templates>
          <br/>
          <br/>
        </li>
      </xsl:if>
      <xsl:if test="$count &lt; $n">
        <xsl:apply-templates select="." mode="iterate">
          <xsl:with-param name="indent" select="$indent"/>
          <xsl:with-param name="count" select="$count + 1"/>
          <xsl:with-param name="index" select="$newindex"/>
          <xsl:with-param name="n" select="$n"/>
        </xsl:apply-templates>
      </xsl:if>
    </xsl:template>

    <xsl:template mode="iterate" match="infeasibleRule">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Rule with Infeasible Conditions</h3>
      The rule
      <xsl:apply-templates select="rule"/>
      has infeasible conditions.
      <xsl:apply-templates select="infeasibilityProof">
        <xsl:with-param name="indent" select="concat($indent, '.1')"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template mode="iterate" match="unfeasibleCCPs">
      <xsl:param name="indent"/>
      <xsl:param name="count"/>
      <xsl:param name="index"/>
      <xsl:param name="n"/>
      <xsl:variable name="newindex" select="$index + count(unfeasibleCCP[$count])"/>
      <xsl:if test="$index != $newindex">
        <xsl:variable name="num" select="$index + count(../contextJoinableCCPs/contextJoinableCCP) + count(../unfeasibleCCPs/unfeasibleCCP)"/>
        <li>
          The
          <xsl:choose>
            <xsl:when test="$num mod 10 = 1 and $num != 11"><xsl:value-of select="$num"/><sup>st</sup></xsl:when>
            <xsl:when test="$num mod 10 = 2 and $num != 12"><xsl:value-of select="$num"/><sup>nd</sup></xsl:when>
            <xsl:when test="$num mod 10 = 3 and $num != 13"><xsl:value-of select="$num"/><sup>rd</sup></xsl:when>
            <xsl:otherwise><xsl:value-of select="$num"/><sup>th</sup></xsl:otherwise>
          </xsl:choose>
          CCP stemming from the overlap of rules
          <xsl:apply-templates select="unfeasibleCCP[$count]/unfeasibilityProof/conditions/*[1]"/>
          and
          <xsl:apply-templates select="unfeasibleCCP[$count]/unfeasibilityProof/conditions/*[2]"/>
          with mgu
          <xsl:apply-templates select="unfeasibleCCP[$count]/*[1]"/>
          is unfeasible.
          <br/>
          <br/>
        </li>
      </xsl:if>
      <xsl:if test="$count &lt; $n">
        <xsl:apply-templates select="." mode="iterate">
          <xsl:with-param name="indent" select="$indent"/>
          <xsl:with-param name="count" select="$count + 1"/>
          <xsl:with-param name="index" select="$newindex"/>
          <xsl:with-param name="n" select="$n"/>
        </xsl:apply-templates>
      </xsl:if>
    </xsl:template>
    

    <xsl:template match="infeasibleCompoundConditions">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Infeasible Compound Conditions</h3>
      <p>
        We collect the conditions in the fresh compound-symbol 
        <xsl:apply-templates select="*[1]"/>.
      </p>
      <xsl:apply-templates select="*[2]">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="aoInfeasibilityProof">
      <xsl:param name="indent"/>
      <!--<h3><xsl:value-of select="$indent"/> Infeasibility Proof for Almost-Orthogonality</h3>
      We are allowed to reduce non-meetability to non-joinability for almost-orthogonality
      modulo infeasibility.-->
      <xsl:apply-templates select="*">
        <xsl:with-param name="indent" select="$indent"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="infeasibilityProof">
      <xsl:param name="indent"/>
      <xsl:apply-templates select="*[1]">
        <xsl:with-param name="indent" select="$indent"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="infeasibleEquation">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Infeasible Equation</h3>
      The equation
      <xsl:for-each select="rule"><xsl:call-template name="condition"/></xsl:for-each>
      is infeasible.
      <xsl:apply-templates select="*[2]">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="infeasibleSubset">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Infeasible Subset</h3>
      We only consider the following subset of conditions:
      <xsl:apply-templates select="rules[1]"/>
      <xsl:apply-templates select="*[2]">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="infeasibleRhssEqual">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Equal Right-Hand Sides</h3>
      There are two conditions with right-hand side
      <xsl:apply-templates select="*[3]"/>
      and respective left-hand sides
      <xsl:apply-templates select="*[1]"/>
      and
      <xsl:apply-templates select="*[2]"/>.
      <xsl:apply-templates select="*[4]">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="infeasibleTrans">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Transitive Condition Composition</h3>
      The right-hand side of the condition
      <xsl:apply-templates select="*[1]"/>
      <xsl:text> </xsl:text>
      <xsl:value-of select="$approx"/>
      <xsl:text> </xsl:text>
      <xsl:apply-templates select="*[2]"/>
      coincides with the left-hand side of the condition
      <xsl:apply-templates select="*[2]"/>
      <xsl:text> </xsl:text>
      <xsl:value-of select="$approx"/>
      <xsl:text> </xsl:text>
      <xsl:apply-templates select="*[3]"/>.
      Therefore, it suffices to show infeasibility of the combined condition
      <xsl:apply-templates select="*[1]"/>
      <xsl:text> </xsl:text>
      <xsl:value-of select="$approx"/>
      <xsl:text> </xsl:text>
      <xsl:apply-templates select="*[3]"/>.
      <xsl:apply-templates select="*[4]">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="nonreachabilityProof">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Non-reachability</h3>
      We show non-reachability w.r.t. the underlying TRS.
      <xsl:apply-templates select="*[1]">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template name="symbol">
      <xsl:param name="symbol" select="."/>
      <xsl:apply-templates select="$symbol/name"/>
      <xsl:text>/</xsl:text>
      <xsl:apply-templates select="$symbol/arity"/>
    </xsl:template>

    <xsl:template match="signature">
      <xsl:text>{</xsl:text>
      <xsl:for-each select="symbol">
        <xsl:if test="position() &gt; 1">, </xsl:if>
        <xsl:call-template name="symbol"/>
      </xsl:for-each>
      <xsl:text>}</xsl:text>
    </xsl:template>

    <xsl:template match="nonreachableReverse">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Non-reachability with reversed Rules</h3>
      In the following we consider non-reachability w.r.t. reversed rewrite rules
      and further swapping source and target term.
      <xsl:apply-templates select="*[1]/*">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="nonreachableTcap">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Non-reachability by TCAP</h3>
      Non-reachability is shown by the TCAP approximation.
    </xsl:template>

    <xsl:template match="nonreachableEtac">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Non-reachability via Exact Tree Automata Completion</h3>
      Considering the signature 
      <xsl:apply-templates select="signature"/>
      as well as the fresh constant
      <xsl:apply-templates select="name[2]"/>
      the following tree automaton (overapproximating the set of ancestors of the ground
      instances of the target term) certifies non-reachability.
      <xsl:apply-templates select="treeAutomaton">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
      States correspond to terms as follows:
      <xsl:apply-templates select="stateMap"/>
    </xsl:template>

    <xsl:template match="nonreachableFGCR">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Non-reachability via Ordered Completion</h3>
      We extend the signature by the binary function symbol
      <xsl:apply-templates select="eqSymbol"/>
      and the two constants
      <xsl:apply-templates select="trueSymbol"/>
      and
      <xsl:apply-templates select="falseSymbol"/>
      and apply ordered completion using the TRS extended by two equality rules as set of initial equations
      E<sub>0</sub>, in order to disprove the equality
      <xsl:apply-templates select="trueSymbol"/> = <xsl:apply-templates select="falseSymbol"/>.

      <xsl:apply-templates select="orderedCompletion">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="stateMap">
      <p>
      <table>
      <xsl:for-each select="entry">
        <tr>
        <td align="right">
        <xsl:apply-templates select="state"/>
        </td>
        <td align="center">
        <xsl:value-of select="$mapsto"/>
        </td>
        <td align="left">
        <xsl:apply-templates select="*[2]"/>
        </td>
        </tr>
      </xsl:for-each>
      </table>
      </p>
    </xsl:template>

    <xsl:template match="left">
      Inl(<xsl:apply-templates select="*[1]"/>)
    </xsl:template>

    <xsl:template match="right">
      Inr(<xsl:apply-templates select="*[1]"/>)
    </xsl:template>

    <xsl:template match="nonreachableSubstApprox">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Non-reachability via Substitution Approximation</h3>
      The following TRS
      <xsl:apply-templates select="rules"/>
      is a substitution approximation of the above TRS.
      <xsl:apply-templates select="nonreachabilityProof/*[1]">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="aoLhssEqual">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Equal Left-Hand Sides</h3>
      There are two conditions with left-hand side
      <xsl:apply-templates select="*[1]"/>
      and respective right-hand sides
      <xsl:apply-templates select="*[2]"/>
      and
      <xsl:apply-templates select="*[3]"/>.
      <xsl:apply-templates select="nonjoinabilityProof">
        <xsl:with-param name="indent" select="concat($indent, '.', 1)"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="nonjoinabilityProof">
      <xsl:param name="indent"/>
      <xsl:apply-templates select="*[1]">
        <xsl:with-param name="indent" select="$indent"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="nonjoinableTcap">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Non-joinability by TCAP</h3>
      Non-joinability is shown by the TCAP approximation.
    </xsl:template>

    <xsl:template match="nonJoinableFork" mode="ncr">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Non-Joinable Fork</h3>
        The system is not confluent due to the following forking derivations.  
        <table>
          <tr>
            <td><xsl:apply-templates select="terms/*[1]"/></td>
            <td><xsl:value-of select="$arrow"/><sup>*</sup></td>
            <td><xsl:apply-templates select="terms/*[2]"/></td>
          </tr>
        </table>
        <table>
          <tr>
            <td><xsl:apply-templates select="terms/*[1]"/></td>
            <td><xsl:value-of select="$arrow"/><sup>*</sup></td>
            <td><xsl:apply-templates select="terms/*[3]"/></td>
          </tr>
        </table>
        The two resulting terms cannot be joined for the following reason:
        <ul><xsl:apply-templates select="*[4]"/></ul>        
    </xsl:template>    

    <xsl:template match="nonJoinableFork">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Non-Joinable Fork</h3>
        The system is not confluent due to the following forking derivations.  
        <p>            
          <xsl:apply-templates select="*[1]"/>
        </p>    
        <p>            
            <xsl:apply-templates select="*[2]"/>
        </p>            
        The two resulting terms cannot be joined for the following reason:
        <ul><xsl:apply-templates select="*[3]"/></ul>        
    </xsl:template>    
    
    <xsl:template match="distinctNormalForms">
        <li>The terms are distinct normal forms.
        </li>
    </xsl:template>
    
    <xsl:template match="capNotUnif">
        <li>When applying the cap-function on both terms (where variables may be treated like constants)
            then the resulting terms do not unify.</li>
    </xsl:template>
    
    <xsl:template match="emptyTreeAutomataIntersection">
        <li>
        The reachable terms of these two terms are approximated via the following two tree automata,
        and the tree automata have an empty intersection.
        <ul>
            <li><p>Automaton 1</p>
                <xsl:for-each select="firstAutomaton">
                    <xsl:call-template name="compatibleTreeAutomaton"/>
                </xsl:for-each>                        
            </li>
            <li><p>Automaton 2</p>
                <xsl:for-each select="secondAutomaton">
                    <xsl:call-template name="compatibleTreeAutomaton"/>
                </xsl:for-each>                        
            </li>
        </ul></li>
    </xsl:template>

    <xsl:template match="grounding">
        <li>We apply the substitution <xsl:apply-templates select="substitution"/> on both terms and show that the resulting instances are not joinable.</li>
        <xsl:apply-templates select="*[2]"/>        
    </xsl:template>

    <xsl:template match="subterm">
        <li>We consider the subterms at position <xsl:apply-templates select="*[1]"/></li>
        <xsl:apply-templates select="*[2]"/>        
    </xsl:template>
    
    <xsl:template match="usableRulesNonJoin">
        <xsl:choose>
            <xsl:when test="count(*) = 1">
                <li>We take the usable rules of the first term (w.r.t. the TRS for the first term)
                    and the usable rules of the second term (w.r.t. the TRS for the second term).
                    Then the terms are not joinable w.r.t. the resulting TRSs.</li>
            </xsl:when>
            <xsl:otherwise>
                <xsl:variable name="dir"><xsl:choose>
                    <xsl:when test="left">first</xsl:when>
                    <xsl:otherwise>second</xsl:otherwise>
                </xsl:choose></xsl:variable>
                <li>We take following (instantiated) usable rules of the <xsl:value-of select="$dir"/>
                    term (w.r.t. the TRS for the <xsl:value-of select="$dir"/> term).
                    <xsl:apply-templates select="usableRules"/>
                    Then the terms are not joinable w.r.t. the resulting TRSs.</li>
            </xsl:otherwise>
        </xsl:choose>
        <xsl:apply-templates select="*[last()]"/>        
    </xsl:template>
    
    <xsl:template match="argumentFilterNonJoin">
        <li>We filter all terms and rules w.r.t. the following argument filter.
        <xsl:apply-templates select="argumentFilter"/>
            Then the resulting terms are not joinable w.r.t. the resulting TRSs.</li>
        <xsl:apply-templates select="*[2]"/>        
    </xsl:template>
    
    <xsl:template match="strictDecrease">
        <li>The first mentioned term is strictly larger than the second one. Here, the following discrimination pair has
         been used w.r.t. the following interpretation.
         Moreover, the (reversed) rules are weakly decreasing.
         The discrimination pair is given by a 
        <xsl:apply-templates select="orderingConstraintProof"/>
        </li>
    </xsl:template>
    
    <xsl:template match="differentInterpretation">
        <li>The first mentioned term is different (not smaller than) the second one w.r.t. the following interpretation.
        Moreover, the (reversed) rules are (quasi)-models of the interpretation.
            <xsl:apply-templates select="model"/></li>
    </xsl:template>
    
    <xsl:template name="compatibleTreeAutomaton">
        <xsl:apply-templates select="treeAutomaton"/>
        <xsl:apply-templates select="criterion"/>
    </xsl:template>

    <xsl:template match="criterion">
        <xsl:choose>
            <xsl:when test="compatibility">
                The automaton is closed under rewriting as it is compatible.
            </xsl:when>
            <xsl:when test="stateCompatibility">
                The automaton is closed under rewriting as it is state-compatible w.r.t. the following relation.
                <table>
                    <xsl:for-each select="stateCompatibility/relation/entry">
                        <tr>
                            <td align="right">
                                <xsl:apply-templates select="state[1]"/>
                            </td>
                            <td><xsl:value-of select="$gege"/></td>
                            <td align="left"><xsl:apply-templates select="state[2]"/></td>
                        </tr>
                    </xsl:for-each>
                </table>                
            </xsl:when>
            <xsl:when test="decisionProcedure">
                The automaton is closed under rewriting as can be seen by the decision procedure.
            </xsl:when>
            <xsl:otherwise>
                The automaton is closed under rewriting as it is compatible.
            </xsl:otherwise>
        </xsl:choose> 
    </xsl:template>

    <xsl:template match="orthogonal">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> (Weakly) Orthogonal</h3>
        Confluence is proven since the TRS is (weakly) orthogonal.
    </xsl:template>

    <xsl:template match="stronglyClosed">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Strongly closed</h3>
        Confluence is proven since the TRS is strongly closed. 
        The joins can be performed within <xsl:value-of select="./text()"/> step(s).
    </xsl:template>

    <xsl:template match="parallelClosed">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Parallel Closed</h3>
        Confluence is proven since the TRS is (almost) parallel closed.
        <xsl:choose>
          <xsl:when test="./text() != ''">
            The joins can be performed using rewrite sequences of length at most <xsl:value-of select="./text()"/>.
          </xsl:when>
          <xsl:otherwise>
            The joins can be performed by approximating rewrite sequences by a parallel rewrite step.
          </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <xsl:template match="criticalPairClosingSystem">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Critical Pair Closing System</h3>
        <p>Confluence is proven using the following terminating critical-pair-closing-system R:</p>
        <xsl:apply-templates select="./trs/rules"/>
        <xsl:apply-templates select="./trsTerminationProof">
          <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="ruleLabeling">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Rule Labeling</h3>
      Confluence is proven, because all critical peaks can be joined decreasingly
      using the following rule labeling function (rules that are not shown have label 0).
      <xsl:apply-templates select="ruleLabelingFunction" />
      <xsl:apply-templates select="joinableCriticalPairs" />
    </xsl:template>

    <xsl:template match="ruleLabelingConv">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Rule Labeling (Conversion Version)</h3>
      Confluence is proven, because all critical peaks can be converted decreasingly
      using the following rule labeling function (rules that are not shown have label 0).
      <xsl:apply-templates select="ruleLabelingFunction" />
      <xsl:apply-templates select="convertibleCriticalPeaks" />
      <xsl:choose>
        <xsl:when test="nrSteps">
          The fan property is satisfied in at most <xsl:value-of select="nrSteps/text()"/> steps(s).
        </xsl:when>
      </xsl:choose>
    </xsl:template>

    <xsl:template match="convertibleCriticalPeaks">
      <xsl:choose>
        <xsl:when test="convertibleCriticalPeak/source">
          All critical peaks are convertible:
          <ul>
            <xsl:for-each select="convertibleCriticalPeak">
              <li>
                <xsl:apply-templates select="conversionLeft/conversion[1]/startTerm"/>
                <xsl:for-each select="conversionLeft/conversion[1]/equationStep">
                  <xsl:choose>
                    <xsl:when test="leftRight"><xsl:value-of select="$rewrite"/></xsl:when>
                    <xsl:when test="rightLeft"><xsl:value-of select="$rewriteRev"/></xsl:when>
                  </xsl:choose>
                  <xsl:apply-templates select="*[last()]"/>
                </xsl:for-each> =
                <xsl:apply-templates select="conversionLeft/rewriteSequence/startTerm"/>
                <xsl:for-each select="conversionLeft/rewriteSequence/rewriteStep">
                  <xsl:value-of select="$rewrite"/>
                  <xsl:apply-templates select="*[last()]"/>
                </xsl:for-each> =
                <xsl:apply-templates select="conversionLeft/conversion[2]/startTerm"/>
                <xsl:for-each select="conversionLeft/conversion[2]/equationStep">
                  <xsl:choose>
                    <xsl:when test="leftRight"><xsl:value-of select="$rewrite"/></xsl:when>
                    <xsl:when test="rightLeft"><xsl:value-of select="$rewriteRev"/></xsl:when>
                  </xsl:choose>
                  <xsl:apply-templates select="*[last()]"/>
                </xsl:for-each> =
                <xsl:for-each select="conversionRight/conversion[2]/equationStep">
                  <xsl:sort select="position()" data-type="number" order="descending"/>
                  <xsl:apply-templates select="*[last()]"/>
                  <xsl:choose>
                    <xsl:when test="leftRight"><xsl:value-of select="$rewriteRev"/></xsl:when>
                    <xsl:when test="rightLeft"><xsl:value-of select="$rewrite"/></xsl:when>
                  </xsl:choose>
                </xsl:for-each>
                <xsl:apply-templates select="conversionRight/conversion[2]/startTerm"/> =
                <xsl:for-each select="conversionRight/rewriteSequence/rewriteStep">
                  <xsl:sort select="position()" data-type="number" order="descending"/>
                  <xsl:apply-templates select="*[last()]"/>
                  <xsl:value-of select="$rewriteRev"/>
                </xsl:for-each>
                <xsl:apply-templates select="conversionRight/rewriteSequence/startTerm"/> =
                <xsl:for-each select="conversionRight/conversion[1]/equationStep">
                  <xsl:sort select="position()" data-type="number" order="descending"/>
                  <xsl:apply-templates select="*[last()]"/>
                  <xsl:choose>
                    <xsl:when test="leftRight"><xsl:value-of select="$rewriteRev"/></xsl:when>
                    <xsl:when test="rightLeft"><xsl:value-of select="$rewrite"/></xsl:when>
                  </xsl:choose>
                </xsl:for-each>
                <xsl:apply-templates select="conversionRight/conversion[1]/startTerm"/>
              </li>
            </xsl:for-each>
          </ul>
        </xsl:when>
        <xsl:otherwise>
          There are no non-trivial critical peaks.
        </xsl:otherwise>
      </xsl:choose>
    </xsl:template>

    <xsl:template match="ruleLabelingFunction">
      <ul>
        <xsl:for-each select="ruleLabelingFunctionEntry">
          <li>
            <xsl:apply-templates select="rule/lhs"/>
            <xsl:value-of select="$rewrite"/>
            <xsl:apply-templates select="rule/rhs"/>
            <xsl:value-of select="$mapsto"/>
            <xsl:apply-templates select="*[2]"/>
          </li>
        </xsl:for-each>
      </ul>
    </xsl:template>

    <xsl:template match="decreasingDiagrams">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Decreasing Diagrams</h3>
      <xsl:if test="relativeTerminationProof">
        <h3><xsl:value-of select="$indent"/>.1 Relative Termination Proof</h3>
        <p>The duplicating rules (R) terminate relative to the other rules (S).</p>
        <xsl:apply-templates select="relativeTerminationProof">
          <xsl:with-param name="indent" select="concat($indent, '.1.1')"/>
        </xsl:apply-templates>
      </xsl:if>
      <xsl:apply-templates select="ruleLabeling">
        <xsl:with-param name="indent" select="concat(concat($indent, '.'), count(*))"/>
      </xsl:apply-templates>
      <xsl:apply-templates select="ruleLabelingConv">
        <xsl:with-param name="indent" select="concat(concat($indent, '.'), count(*))"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="redundantRules">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Redundant Rules Transformation</h3>
      <p>
      To prove that the TRS is (non-)confluent, we show (non-)confluence of the following
      modified system:
      </p>
      <xsl:apply-templates select="trs"/>
      <p>
      All redundant rules that were added or removed can be
      simulated in <xsl:value-of select="nrSteps"/> steps
      <xsl:choose>
        <xsl:when test="conversions">
          , or by the following conversions:
          <ul>
            <xsl:for-each select="conversions/conversion">
              <li>
                <xsl:choose>
                  <xsl:when test="equationStep">
                    <xsl:apply-templates select="startTerm"/>
                    <xsl:for-each select="equationStep">
                      <xsl:choose>
                        <xsl:when test="leftRight"><xsl:value-of select="$rewrite"/></xsl:when>
                        <xsl:when test="rightLeft"><xsl:value-of select="$rewriteRev"/></xsl:when>
                      </xsl:choose>
                      <xsl:apply-templates select="*[last()]"/>
                    </xsl:for-each>
                  </xsl:when>
                  <xsl:otherwise>
                    <xsl:apply-templates select="startTerm"/> = <xsl:apply-templates select="startTerm"/>
                  </xsl:otherwise>
                </xsl:choose>
              </li>
            </xsl:for-each>
          </ul>
        </xsl:when>
        <xsl:otherwise>.</xsl:otherwise>
      </xsl:choose>
      </p>
      <xsl:apply-templates select="crProof">
        <xsl:with-param name="indent" select="concat($indent, '.1')"/>
      </xsl:apply-templates>
      <xsl:apply-templates select="crDisproof">
        <xsl:with-param name="indent" select="concat($indent, '.1')"/>
      </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="persistentDecomposition">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Persistent Decomposition (Many-Sorted)</h3>
      <xsl:choose>
        <xsl:when test="./component/crDisproof">Non-confluence</xsl:when>
        <xsl:otherwise>Confluence</xsl:otherwise>
      </xsl:choose>
      is proven, because
      <xsl:choose>
        <xsl:when test="not(./component/crDisproof)">the maximal</xsl:when>
        <xsl:otherwise>a</xsl:otherwise>
      </xsl:choose>
      system<xsl:if test="count(component) > 1">s </xsl:if>
      induced by the sorts in the following many-sorted sort attachment
      <xsl:choose>
        <xsl:when test="count(component) > 1">are </xsl:when>
        <xsl:otherwise>is </xsl:otherwise>
      </xsl:choose>
      <xsl:if test="./component/crDisproof">not </xsl:if>
      confluent.
      <xsl:apply-templates select="manySortedSignature" />
      The subsystem<xsl:choose>
        <xsl:when test="count(component) > 1">s are</xsl:when>
        <xsl:otherwise> is</xsl:otherwise>
      </xsl:choose>
      <xsl:for-each select="component">
        <h4>(<xsl:value-of select="concat($indent,'.',position())"/>)</h4>
        <xsl:apply-templates select="./*[1]"/>
      </xsl:for-each>
      <xsl:for-each select="component">
        <xsl:variable name="index" select="position()"/>
        <xsl:apply-templates select="./*[2]">
          <xsl:with-param name="indent" select="concat($indent,'.', $index)"/>
        </xsl:apply-templates>
      </xsl:for-each>
    </xsl:template>

    <xsl:template match="manySortedSignature">
      <table align="center">
      <xsl:for-each select="manySortedFunction">
        <tr><td>
          <xsl:apply-templates select="./*[1]"/>
          </td><td>:</td><td>
          <xsl:for-each select="args">
            <xsl:for-each select="sort">
              <xsl:value-of select="text()"/>
              <xsl:if test="position() != last()"> ⨯ </xsl:if>
              <xsl:if test="position() = last()"> → </xsl:if>
            </xsl:for-each>
          </xsl:for-each>
          <xsl:for-each select="result/sort">
            <xsl:value-of select="text()"/>
          </xsl:for-each>
        </td></tr>
      </xsl:for-each>
      </table>
    </xsl:template>


    <xsl:template match="subsumptionProof" mode="conversion">
        <xsl:param name="indent"></xsl:param>
        <h3><xsl:value-of select="$indent"/> Conversion Proof with History</h3>
        We provide a series of conversions that follow from the set of equations. Each conversion may be used in upcoming
        conversions, and the desired equation is contained in the conversions.
        <ul><li>
            <xsl:apply-templates select=".">
                <xsl:with-param name="rules">conversions</xsl:with-param>
            </xsl:apply-templates>
        </li></ul>
    </xsl:template>
    

    <xsl:template match="equationalProofTree">
        <xsl:param name="indent"></xsl:param>
        <h3><xsl:value-of select="$indent"/> Equational Proof Tree</h3>
        We give an equational proof tree to show that the equation follows from the set of equations.
        <ul><li>
        <xsl:apply-templates mode="eqProofTree"/>
        </li></ul>
    </xsl:template>
    
    <xsl:template match="conversion">
        <xsl:param name="indent"></xsl:param>
        <h3><xsl:value-of select="$indent"/> Conversion</h3>
        We give a conversion which shows that the equation follows from the set of equations.
        <xsl:choose>
            <xsl:when test="equationStep">
                <table align="center">            
                    <tr><td/><td><xsl:apply-templates select="startTerm"/></td></tr>
                    <xsl:for-each select="equationStep">
                        <tr>
                           <td>                               
                               <xsl:choose>
                                   <xsl:when test="leftRight"><xsl:value-of select="$rewrite"/></xsl:when> 
                                   <xsl:when test="rightLeft"><xsl:value-of select="$rewriteRev"/></xsl:when>                                    
                               </xsl:choose>  
                           </td>
                            <td><xsl:apply-templates select="*[last()]"/></td>
                        </tr>                        
                    </xsl:for-each>
                </table>                    
            </xsl:when>
            <xsl:otherwise>
                The conversion is trivial since <xsl:apply-templates select="startTerm"/> = <xsl:apply-templates select="startTerm"/>.
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    <xsl:template mode="eqProofTree" match="*">
        <xsl:apply-templates mode="eqProofLeft" select="."/> 
        = 
        <xsl:apply-templates mode="eqProofRight" select="."/>
        <xsl:text> </xsl:text>
        <xsl:apply-templates mode="eqProofTree2" select="."/>
    </xsl:template>
    
    <xsl:template mode="eqProofTree2" match="refl">
        (refl)
    </xsl:template>

    <xsl:template mode="eqProofLeft" match="refl">
        <xsl:apply-templates select="*[1]"/>
    </xsl:template>
    
    <xsl:template mode="eqProofRight" match="refl">
        <xsl:apply-templates select="*[1]"/>
    </xsl:template>
        
    <xsl:template mode="eqProofTree2" match="assm">
        (assm using <xsl:apply-templates select="rule"/>)
    </xsl:template>
    
    <xsl:template mode="eqProofLeft" match="assm">
        <xsl:apply-templates select="rule/lhs" mode="apply_subst">
            <xsl:with-param name="subst" select="substitution"/>
        </xsl:apply-templates>
    </xsl:template>    
    
    <xsl:template mode="apply_subst" match="funapp">
        <xsl:param name="subst"/>
        <xsl:apply-templates select="*[1]"/>
        <xsl:if test="count(arg) &gt; 0">
            <xsl:text>(</xsl:text>
            <xsl:for-each select="arg">
                <xsl:apply-templates mode="apply_subst">
                    <xsl:with-param name="subst" select="$subst"/>
                </xsl:apply-templates>
                <xsl:if test="position() != last()">,</xsl:if>
            </xsl:for-each>
            <xsl:text>)</xsl:text>
        </xsl:if>
    </xsl:template>
    
    <xsl:template mode="apply_subst" match="var">
        <xsl:param name="subst"/>
        <xsl:variable name="x" select="text()"/>
        <xsl:choose>
            <xsl:when test="$subst/substEntry[*[1]/text() = $x]">
                <xsl:apply-templates select="($subst/substEntry[*[1]/text() = $x])[1]/*[2]"/>
            </xsl:when>
            <xsl:otherwise>
                <xsl:apply-templates select="."/>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    
    <xsl:template mode="eqProofRight" match="assm">
        <xsl:apply-templates select="rule/rhs"/>
    </xsl:template>
    
    <xsl:template mode="eqProofTree2" match="trans">
        (trans)
        <ul>
            <li>
                <xsl:apply-templates mode="eqProofTree" select="*[1]"/>                
            </li>
            <li>
                <xsl:apply-templates mode="eqProofTree" select="*[2]"/>                
            </li>            
        </ul>
    </xsl:template>

    <xsl:template mode="eqProofLeft" match="trans">
        <xsl:apply-templates mode="eqProofLeft" select="*[1]"/>
    </xsl:template>

    <xsl:template mode="eqProofRight" match="trans">
        <xsl:apply-templates mode="eqProofRight" select="*[2]"/>
    </xsl:template>
    
    <xsl:template mode="eqProofTree2" match="sym">
        (sym)
        <ul>
            <li>
                <xsl:apply-templates  mode="eqProofTree" select="*[1]"/>                
            </li>
        </ul>
    </xsl:template>
    
    <xsl:template mode="eqProofLeft" match="sym">
        <xsl:apply-templates mode="eqProofRight" select="*[1]"/>
    </xsl:template>

    <xsl:template mode="eqProofRight" match="sym">
        <xsl:apply-templates mode="eqProofLeft" select="*[1]"/>
    </xsl:template>
    
    <xsl:template mode="eqProofTree2" match="cong">
        (cong)
        <xsl:if test="count(*) &gt; 1"/>
        <ul>
            <xsl:for-each select="*">
                <xsl:if test="position() != 1">
                    <li><xsl:apply-templates mode="eqProofTree" select="."/></li>
                </xsl:if>                
            </xsl:for-each>
        </ul>
    </xsl:template>    
    
    <xsl:template mode="eqProofLeft" match="cong">
        <xsl:apply-templates select="*[1]"/>
        <xsl:if test="count(*) &gt; 1">
            <xsl:text>(</xsl:text>
            <xsl:for-each select="*">
                <xsl:if test="position() != 1">                    
                    <xsl:apply-templates mode="eqProofLeft" select="."/>
                    <xsl:if test="position() != last()">
                        <xsl:text>,</xsl:text>
                    </xsl:if>
                </xsl:if>                
            </xsl:for-each>
            <xsl:text>)</xsl:text>
        </xsl:if>
    </xsl:template>    

    <xsl:template mode="eqProofRight" match="cong">
        <xsl:apply-templates select="*[1]"/>
        <xsl:if test="count(*) &gt; 1">
            <xsl:text>(</xsl:text>
            <xsl:for-each select="*">
                <xsl:if test="position() != 1">                    
                    <xsl:apply-templates mode="eqProofRight" select="."/>
                    <xsl:if test="position() != last()">
                        <xsl:text>,</xsl:text>
                    </xsl:if>
                </xsl:if>                
            </xsl:for-each>
            <xsl:text>)</xsl:text>
        </xsl:if>
    </xsl:template>    
    
    
    <xsl:template match="completionAndNormalization">
        <xsl:param name="indent"></xsl:param>
        <h3><xsl:value-of select="$indent"/> Completion and Normalization Proof</h3>
        The following rules are a convergent TRS which is equivalent to the set of equations.
        Since both sides of the equation rewrite to the same normal form, the equation follows from 
        the set of equations.
        <xsl:apply-templates select="trs"/>
        <xsl:apply-templates select="completionProof">
            <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>        
    </xsl:template>

    <xsl:template match="completionAndNormalization" mode="neq">
        <xsl:param name="indent"></xsl:param>
        <h3><xsl:value-of select="$indent"/> Completion and Normalization Proof</h3>
        The following rules are a convergent TRS which is equivalent to the set of equations.
        Since both sides of the equation rewrite to different normal form, the equation does not follow from 
        the set of equations.
        <xsl:apply-templates select="trs"/>
        <xsl:apply-templates select="completionProof">
            <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>        
    </xsl:template>
    
    <xsl:template match="completionProof">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Completion Proof</h3>
        We have to prove termination and local confluence of R, and equivalence of R and E.
        <xsl:apply-templates select="trsTerminationProof">
            <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
        <xsl:apply-templates select="wcrProof">
            <xsl:with-param name="indent" select="concat($indent,'.2')"/>
        </xsl:apply-templates>
        <xsl:apply-templates select="equivalenceProof">
            <xsl:with-param name="indent" select="concat($indent,'.3')"/>
        </xsl:apply-templates>        
    </xsl:template>
    
    <xsl:template match="deduce">
      deduce
      <xsl:apply-templates select="*[2]"/>
      <xsl:value-of select="$rewriteRev"/>
      <xsl:apply-templates select="*[1]"/>
      <xsl:value-of select="$rewrite"/>
      <xsl:apply-templates select="*[3]"/>
    </xsl:template>
    
    <xsl:template match="orientl">
      orient left-to-right
      <xsl:apply-templates select="*[1]"/>
      <xsl:value-of select="$rewrite"/>
      <xsl:apply-templates select="*[2]"/>
    </xsl:template>
    
    <xsl:template match="orientr">
      orient right-to-left
      <xsl:apply-templates select="*[2]"/>
      <xsl:value-of select="$rewrite"/>
      <xsl:apply-templates select="*[1]"/>
    </xsl:template>
    
    <xsl:template match="delete">
      delete
      <xsl:apply-templates select="*[1]"/>
      =
      <xsl:apply-templates select="*[1]"/>
    </xsl:template>

    <xsl:template match="simplifyl">
      left-simplify
      <xsl:apply-templates select="*[1]"/>
      =
      <xsl:apply-templates select="*[2]"/>
      to
      <xsl:apply-templates select="*[3]"/>
      =
      <xsl:apply-templates select="*[2]"/>
    </xsl:template>

    <xsl:template match="simplifyr">
      right-simplify
      <xsl:apply-templates select="*[1]"/>
      =
      <xsl:apply-templates select="*[2]"/>
      to
      <xsl:apply-templates select="*[1]"/>
      =
      <xsl:apply-templates select="*[3]"/>
    </xsl:template>

    <xsl:template match="collapse">
      collapse
      <xsl:apply-templates select="*[1]"/>
      ->
      <xsl:apply-templates select="*[2]"/>
      to
      <xsl:apply-templates select="*[3]"/>
      =
      <xsl:apply-templates select="*[2]"/>
    </xsl:template>

    <xsl:template match="compose">
      compose
      <xsl:apply-templates select="*[1]"/>
      ->
      <xsl:apply-templates select="*[2]"/>
      to
      <xsl:apply-templates select="*[1]"/>
      ->
      <xsl:apply-templates select="*[3]"/>
    </xsl:template>

    <xsl:template match="run">
        The run consists of the following steps:
        <ol>
          <xsl:for-each select="orderedCompletionStep">
            <li>    
            <xsl:apply-templates select="."/>
            </li>
          </xsl:for-each>
        </ol>  
    </xsl:template> 
    
    <xsl:template match="orderedCompletionProof">
        An ordered completion run on E<sub>0</sub> using the given reduction order
        produces the system (E,R).
        <xsl:apply-templates select="run"/>
    </xsl:template>   
        
    <xsl:template match="equivalenceProof">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Equivalence Proof of R and E</h3>
        <p>
            R can be simulated by E as follows.
        <xsl:apply-templates select="subsumptionProof[1]"/>
        </p>
        <p>            
            <xsl:choose>
                <xsl:when test="subsumptionProof[2]">
                    E can be simulated by R as follows.
                    <xsl:apply-templates select="subsumptionProof[2]">
                        <xsl:with-param name="rules">equations</xsl:with-param>
                        <xsl:with-param name="equations">rules</xsl:with-param>
                    </xsl:apply-templates>
                </xsl:when>
                <xsl:otherwise>
                    That E can be simulated by R can be shown by just computing normal forms of each equation in E.
                </xsl:otherwise>
            </xsl:choose>
            
            
        </p>        
    </xsl:template>
    
    <xsl:template match="wcrProof">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Local Confluence Proof</h3>
        <xsl:apply-templates select="*[1]"/>        
    </xsl:template>
    
    <xsl:template match="joinableCriticalPairsAuto">
        All critical pairs are joinable which can be seen by computing normal forms of all critical pairs.
    </xsl:template>

    <xsl:template match="joinableCriticalPairsBFS">
        All critical pairs are joinable within 
        <xsl:value-of select="text()"/> step(s).
    </xsl:template>
    
    <xsl:template match="joinableCriticalPairs">
        <xsl:choose>
            <xsl:when test="joinableCriticalPair/rewriteSequence/rewriteStep">
                All critical pairs are joinable:
                <ul>
                    <xsl:for-each select="joinableCriticalPair">
                        <li>
                            <xsl:apply-templates select="rewriteSequence[1]/startTerm"/>
                            <xsl:for-each select="rewriteSequence[1]/rewriteStep">
                                <xsl:value-of select="$rewrite"/>
                                <xsl:apply-templates select="*[last()]"/>
                            </xsl:for-each>
                            <xsl:for-each select="rewriteSequence[2]/rewriteStep">
                                <xsl:variable name="i" select="last() - position()"/>
                                <xsl:value-of select="$rewriteRev"/>
                                <xsl:choose>
                                    <xsl:when test="$i = 0">
                                        <xsl:apply-templates select="../startTerm"/>
                                    </xsl:when>
                                    <xsl:otherwise>
                                        <xsl:apply-templates select="../rewriteStep[$i]/*[3]"/>
                                    </xsl:otherwise>
                                </xsl:choose>
                            </xsl:for-each>                            
                        </li>
                    </xsl:for-each>
                </ul>
            </xsl:when>
            <xsl:otherwise>
                There are no non-trivial critical pairs.
            </xsl:otherwise>
        </xsl:choose>        
    </xsl:template>    
    
    <xsl:template match="subsumptionProof">
        <xsl:param name="rules">rules</xsl:param>
        <xsl:param name="equations">equations</xsl:param>
            All <xsl:value-of select="$rules"/> could be derived from the <xsl:value-of select="$equations"/>
            <ul>
            <xsl:for-each select="ruleSubsumptionProof/conversion[count(equationStep) != 0]">
                    <li>
                            <xsl:apply-templates select="startTerm"/>
                            <xsl:for-each select="equationStep">
                                <xsl:choose>
                                    <xsl:when test="leftRight"><xsl:value-of select="$rewrite"/></xsl:when> 
                                    <xsl:when test="rightLeft"><xsl:value-of select="$rewriteRev"/></xsl:when>                                    
                                </xsl:choose>
                                <xsl:apply-templates select="*[last()]"/>
                            </xsl:for-each>
                        </li>
                    </xsl:for-each>
                </ul>
    </xsl:template>
    
    <xsl:template match="trsNonterminationProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*" mode="nonterm">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
      
    
    <xsl:template match="relativeTerminationProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*" mode="relative">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>

    <xsl:template match="relativeNonterminationProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*" mode="relNonterm">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="dpNonterminationProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*" mode="dpNonterm">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="dpProof">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="orderingConstraintProof">
        <xsl:apply-templates select="*"/>
    </xsl:template>
    
    <xsl:template match="innermostLhss" mode="optional">
        <xsl:choose>
            <xsl:when test="count(*) = 0"/>            
            <xsl:otherwise>
                <p>Innermost rewriting w.r.t. the following left-hand sides is considered:</p>
                <table align="center">
                    <xsl:for-each select="*">
                        <tr><td align="left"><xsl:apply-templates select="."/></td></tr>
                    </xsl:for-each>
                </table>
            </xsl:otherwise>
        </xsl:choose>        
    </xsl:template>
    
    <xsl:template match="innermostLhss">
        <xsl:choose>
            <xsl:when test="count(*) = 0">
                <p>There are no lhss.</p>
            </xsl:when>
            <xsl:otherwise>
                <table align="center">
                    <xsl:for-each select="*">
                        <tr><td align="left"><xsl:apply-templates select="."/></td></tr>
                    </xsl:for-each>
                </table>
            </xsl:otherwise>
        </xsl:choose>        
    </xsl:template>
    
    <xsl:template match="strategy">
        <xsl:choose>
            <xsl:when test="innermost">
                <xsl:text>The evaluation strategy is innermost.</xsl:text>
            </xsl:when>
            <xsl:when test="innermostLhss">
                <xsl:text>The evaluation strategy is innermost w.r.t. the following set of left-hand sides.</xsl:text>
                <xsl:apply-templates select="innermostLhss"/>
            </xsl:when>
            <xsl:when test="outermost">
                <xsl:text>The evaluation strategy is outermost</xsl:text>
            </xsl:when>
            <xsl:when test="forbiddenPatterns">
                <xsl:text>The evaluation strategy is determined by the following forbidden patterns.</xsl:text>
                <xsl:apply-templates select="forbiddenPatterns"/>
            </xsl:when>
            <xsl:when test="contextSensitive">
                <xsl:text>The evaluation strategy is context sensitive with the following replacement map.</xsl:text>
                <table>
                    <xsl:for-each select="contextSensitive/replacementMapEntry">
                        <tr>
                            <td align="right"><xsl:value-of select="$mu"/>(<xsl:apply-templates select="*[1]"/>)</td>
                            <td align="center"> = </td>
                            <td align="left">{ <xsl:for-each select="position"><xsl:if test="position() &gt; 1">, </xsl:if><xsl:value-of select="text()"/></xsl:for-each> }</td>
                        </tr>
                    </xsl:for-each>
                </table>
                <xsl:apply-templates select="forbiddenPatterns"/>
            </xsl:when>
        </xsl:choose>
        
    </xsl:template>
    
    <xsl:template match="forbiddenPatterns">
        <table align="center">
            <xsl:for-each select="forbiddenPattern">
                <tr>
                    <td>(</td><td><xsl:apply-templates select="*[1]"/></td>
                    <td>,</td>
                    <td><xsl:apply-templates select="*[2]"/></td>
                    <td>,</td>
                    <td><xsl:choose>
                        <xsl:when test="above">above</xsl:when>
                        <xsl:when test="below">below</xsl:when>
                        <xsl:when test="here">here</xsl:when>
                    </xsl:choose>
                    </td>
                    <td>)</td>
                </tr>
            </xsl:for-each>
        </table>        
    </xsl:template>
    
    <xsl:template match="unknownInput">
        Unsupported input <i><xsl:value-of select="text()"/></i> 
    </xsl:template>
    
    <xsl:template match="trsInput">        
            <xsl:choose>
                <xsl:when test="relativeRules">
                    <p>The relative rewrite relation R/S is considered where R is the following TRS</p>                    
                    <xsl:apply-templates select="trs/rules"/>
                    <p>and S is the following TRS.</p>
                    <xsl:apply-templates select="relativeRules/rules"/>
                </xsl:when>
                <xsl:otherwise>
                    <p>The rewrite relation of the following TRS is considered.</p>
                        <xsl:apply-templates select="trs/rules"/>                        
                </xsl:otherwise>
            </xsl:choose>
            <xsl:apply-templates select="strategy"/>                
    </xsl:template>
    
    <xsl:template match="ctrsInput">        
            <p>The rewrite relation of the following conditional TRS is considered.</p>
            <xsl:apply-templates select="rules"/>                                        
    </xsl:template>
    
    <xsl:template match="acRewriteSystem">        
        <p>The rewrite relation of the following equational TRS is considered.</p>
        <xsl:apply-templates select="trs"/>
        <xsl:if test="Asymbols/*">
            <p>Associative symbols: <xsl:for-each select="Asymbols/*"><xsl:if test="position() != 1">, </xsl:if><xsl:apply-templates/></xsl:for-each></p>
        </xsl:if>
        <xsl:if test="Csymbols/*">
            <p>Commutative symbols: <xsl:for-each select="Csymbols/*"><xsl:if test="position() != 1">, </xsl:if><xsl:apply-templates/></xsl:for-each></p>
        </xsl:if>
    </xsl:template>
    
    <xsl:template match="treeAutomatonProblem">
        <p>It should be guaranteed that the given automaton is closed under rewriting w.r.t. the given TRS.</p>
        <ul>
            <li>Automaton:<br/>
                <xsl:apply-templates select="*[1]"/>
            </li>
            <li>Term Rewrite System<br/>
                <xsl:apply-templates select="*[2]"/>
            </li>
        </ul>                
    </xsl:template>
    
    <xsl:template match="complexityInput">
        <p>
            <xsl:choose>
                <xsl:when test="derivationalComplexity">
                    Derivational
                </xsl:when>
                <xsl:when test="runtimeComplexity">
                    Runtime
                </xsl:when>
            </xsl:choose>            
            <xsl:text>complexity of the following relation is considered.</xsl:text>
            <xsl:text>The intended complexity is O(</xsl:text>
            <xsl:apply-templates select="*[3]" mode="complexity_class"/>
            <xsl:text>).</xsl:text>
            <xsl:choose>
                <xsl:when test="runtimeComplexity">
                    The constructors are 
                    <xsl:for-each select="runtimeComplexity/signature[1]/symbol">
                        <xsl:if test="position() != 1">, </xsl:if>
                        <xsl:apply-templates select="*[1]"/>
                    </xsl:for-each> and the defined symbols are 
                    <xsl:for-each select="runtimeComplexity/signature[2]/symbol">
                        <xsl:if test="position() != 1">, </xsl:if>
                        <xsl:apply-templates select="*[1]"/>
                    </xsl:for-each>.
                </xsl:when>
                <xsl:when test="derivationalComplexity">
                    The following symbols are considered:  
                    <xsl:for-each select="derivationalComplexity/signature/symbol">
                        <xsl:if test="position() != 1">, </xsl:if>
                        <xsl:apply-templates select="*[1]"/>
                    </xsl:for-each>.
                </xsl:when>
            </xsl:choose>        
        </p>
            <xsl:apply-templates select="trsInput"/>                                        
    </xsl:template>
    
    <xsl:template mode="complexity_class" match="polynomial">
        <xsl:choose>
            <xsl:when test="text() = 0">1</xsl:when>
            <xsl:when test="text() = 1">n</xsl:when>
            <xsl:otherwise>n<sup><xsl:value-of select="text()"/></sup></xsl:otherwise>
        </xsl:choose>        
    </xsl:template>
    
    
    <xsl:template match="completionInput">
        <p> For the following equations E</p> 
            <xsl:apply-templates select="equations"/>
            <p>and the following TRS R</p>
            <xsl:apply-templates select="trs/rules"/>
            <p>it is proven that E is equivalent to R, and R is convergent.
        </p>        
    </xsl:template>
    
    <xsl:template match="orderedCompletionInput">
        <p> We consider the set of initial equations E<sub>0</sub>:</p> 
            <xsl:apply-templates select="equations"/>
        <p>
            <xsl:apply-templates select="orderedCompletionResult"/>
        </p>
    </xsl:template>
    
    <xsl:template match="orderedCompletionResult">
        <p>Ordered completion results in the TRS R</p>
            <xsl:apply-templates select="trs/rules"/>
        <p>and the set of equations E</p>
            <xsl:apply-templates select="equations"/>
        <p>It is proven that E<sub>0</sub> is equivalent to (E,R),
           and (E,R) is ground complete with respect to the following reduction order:
        </p>
            <xsl:apply-templates select="reductionOrder"/>
    </xsl:template>

    <xsl:template match="equationalReasoningInput">
        <p> We consider the equations E</p> 
            <xsl:apply-templates select="equations"/>
        <p>
        <xsl:variable name="goal">
            <xsl:choose>
                <xsl:when test="inequality">inequality</xsl:when>
                <xsl:otherwise>equation</xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:variable name="op">
            <xsl:choose>
                <xsl:when test="inequality">&#8800;</xsl:when>
                <xsl:otherwise>=</xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        the <xsl:copy-of select="$goal"/>
        <table align="center">
            <tr>
                <td align="right"><xsl:apply-templates select="*[2]/*[1]"/></td>
                <td align="center"><xsl:copy-of select="$op"/></td>
                <td align="right"><xsl:apply-templates select="*[2]/*[2]"/></td>
            </tr>
        </table>
        and the question, whether the <xsl:copy-of select="$goal"/>
        is a consequence of E.
        </p>        
    </xsl:template>
    
    
    <xsl:template match="dpInput">        
            <p>The DP problem (P,R) is considered where P are the following pairs</p>                    
                    <xsl:apply-templates select="dps/rules"/>
                    <p>and R is the following TRS.</p>
                    <xsl:apply-templates select="trs/rules"/>
        <xsl:if test="minimal/text() = 'true'"><p>Only minimal chains are regarded.</p> </xsl:if>
        <xsl:apply-templates select="strategy"/>                            
    </xsl:template>
    
    <xsl:template match="variableConditionViolated" mode="nonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Variable Condition Violated</h3>
        <p>The TRS violates one of the two variable conditions. Thus, it is not terminating.</p>
    </xsl:template>

    <xsl:template match="variableConditionViolated" mode="relNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Variable Condition Violated</h3>
        <p>The relative termination problem R/S violates the variable condition. Thus, it is not relative terminating.</p>
    </xsl:template>
    
    <xsl:template match="positionInTerm">
        <xsl:choose>
            <xsl:when test="count(position) = 0">
                <xsl:value-of select="$epsilon"/>
            </xsl:when>
            <xsl:otherwise>
                <xsl:for-each select="position">
                    <xsl:if test="position() != 1">
                        <xsl:text>.</xsl:text>
                    </xsl:if>
                    <xsl:value-of select="text()"/>
                </xsl:for-each>
            </xsl:otherwise>
        </xsl:choose>       
    </xsl:template>
    
    <xsl:template match="rewriteSequence">
        <xsl:param name="strict"/>
        <xsl:param name="nonstrict"/>
        <xsl:variable name="str">
            <xsl:choose>
                <xsl:when test="$strict != ''">
                    <xsl:value-of select="$strict"/>
                    <xsl:text>,</xsl:text>
                </xsl:when>
            </xsl:choose>
        </xsl:variable>
        <xsl:variable name="nstr">
            <xsl:choose>
                <xsl:when test="$nonstrict != ''">
                    <xsl:value-of select="$nonstrict"/>
                    <xsl:text>,</xsl:text>
                </xsl:when>
            </xsl:choose>
        </xsl:variable>
        <table>
            <xsl:attribute name="align">center</xsl:attribute>
            <tr>
                <td align="right">t<sub>0</sub></td>
                <td align="center">=</td>
                <td align="left"><xsl:apply-templates select="startTerm/*"/></td>
            </tr>
            <xsl:for-each select="rewriteStep">
                <tr>
                    <td/>
                    <td align="center"><xsl:value-of select="$arrow"/><sub>
                        <xsl:choose>
                            <xsl:when test="relative"><xsl:value-of select="$nstr"/></xsl:when>
                            <xsl:otherwise><xsl:value-of select="$str"/></xsl:otherwise>
                        </xsl:choose>                        
                        <xsl:apply-templates select="positionInTerm"/>
                    </sub></td>
                    <td align="left"><xsl:apply-templates select="*[last()]"/></td>
                </tr>
            </xsl:for-each>
            <tr>
                <td/>
                <td align="center">=</td>
                <td align="left">t<sub><xsl:value-of select="count(rewriteStep)"/></sub></td>
            </tr>
        </table>
    </xsl:template>        

    <xsl:template match="nonterminatingSRS" mode="nonterm">
        <xsl:param name="indent"/>
        <xsl:call-template name="nonloopSRS">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template match="string">
        <xsl:choose>
            <xsl:when test="count(*) = 0">
                <xsl:value-of select="$epsilon"/>
            </xsl:when>
            <xsl:otherwise>
                <xsl:for-each select="*">
                    <xsl:apply-templates select="."/>
                    <xsl:if test="position() &lt; last()"><xsl:text> </xsl:text></xsl:if>
                </xsl:for-each>
            </xsl:otherwise>
        </xsl:choose>
        
    </xsl:template>

    <xsl:template name="nonloopSRS">
        <xsl:param name="indent"/>
        <xsl:apply-templates select="*[2]">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="selfEmbeddingOC">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Looping derivation</h3>
        <p>There is a looping derivation.</p>                
        <p><xsl:apply-templates select="*[2]"/><xsl:text> </xsl:text><xsl:value-of select="$arrow"/><sup>+</sup><xsl:text> </xsl:text><i><xsl:apply-templates select="*[1]"/></i>
            <xsl:text> </xsl:text><xsl:apply-templates select="*[2]"/><xsl:text> </xsl:text><i><xsl:apply-templates select="*[3]"/></i></p>
        <xsl:apply-templates select="../*[1]"/>
    </xsl:template>

    <xsl:template match="selfEmbeddingDP">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Infinite derivation</h3>
        <p>There is a self-embedding derivation structure which implies nontermination.</p>
        <p><xsl:apply-templates select="*[1]"/></p>
        <xsl:apply-templates select="../*[1]"/>
    </xsl:template>
    
    <xsl:template match="derivationPatterns">
        <p>The derivation can be derived as follows.</p>
        <ul>
            <xsl:apply-templates/>
        </ul>
    </xsl:template>

    <xsl:template match="derivationPattern">
        <xsl:apply-templates select="wordPattern[1]"/><xsl:text> </xsl:text><xsl:value-of select="$arrow"/><sup>+</sup><xsl:text> </xsl:text><xsl:apply-templates select="wordPattern[2]"/>
    </xsl:template>

    <xsl:template match="wordPattern">
        <xsl:variable name="factor"><xsl:choose>
            <xsl:when test="factor/text() = '1'"></xsl:when>
            <xsl:otherwise><xsl:value-of select="factor/text()"/></xsl:otherwise>
        </xsl:choose></xsl:variable>
        <xsl:variable name="constant"><xsl:choose>
            <xsl:when test="constant/text() = '0'"></xsl:when>
            <xsl:otherwise> + <xsl:value-of select="constant/text()"/></xsl:otherwise>
        </xsl:choose></xsl:variable>
        <xsl:if test="count(string[1]/*) &gt; 0"><xsl:apply-templates select="string[1]"/><xsl:text> </xsl:text></xsl:if>
        (<xsl:apply-templates select="string[2]"/>)<sup><xsl:value-of select="$factor"/>n<xsl:value-of select="$constant"/></sup>
        <xsl:if test="count(string[3]/*) &gt; 0"><xsl:text> </xsl:text><xsl:apply-templates select="string[3]"/></xsl:if>
    </xsl:template>
    
    <xsl:template match="overlapClosureSRS">
        <xsl:apply-templates select="string[1]"/><xsl:text> </xsl:text><xsl:value-of select="$arrow"/><sup>+</sup><xsl:text> </xsl:text><xsl:apply-templates select="string[2]"/>
    </xsl:template>
    
    <xsl:template match="derivationPatternProof">
        <li><xsl:apply-templates select="*[1]/*[1]"/>: 
        <xsl:choose>
            <xsl:when test="OC1">
                This is an original rule (OC1).
            </xsl:when>
            <xsl:when test="OC2">
                The overlap closure is obtained from the following two overlap closures (OC2). 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="OC2prime">
                The overlap closure is obtained from the following two overlap closures (OC2'). 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="OC3">
                The overlap closure is obtained from the following two overlap closures (OC3). 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="OC3prime">
                The overlap closure is obtained from the following two overlap closures (OC3'). 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="OCintoDP1">
                The derivation pattern is obtained from the following self-overlapping overlap closure (type 1)
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="OCintoDP2">
                The derivation pattern is obtained from the following self-overlapping overlap closure (type 2)
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="equivalent">
                The derivation pattern is equivalent to the following derivation pattern. 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="lift">
                The derivation pattern is obtained from lifting the following derivation pattern. 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_OC_1_1">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP OC 1.1) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_OC_1_2">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP OC 1.2) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_OC_2">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP OC 2) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_OC_3_1">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP OC 3.1) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_OC_3_2">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP OC 3.2) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_DP_1_1">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP DP 1.1) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_DP_1_2">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP DP 1.2) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_DP_2_1">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP DP 2.1) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="DP_DP_2_2">
                The derivation pattern is obtained from overlapping the following two derivation patterns (DP DP 2.2) 
                <ul>
                    <li><xsl:apply-templates select="*[1]/*[2]"/></li>
                    <li><xsl:apply-templates select="*[1]/*[3]"/></li>
                </ul>
            </xsl:when>            
            <xsl:otherwise>
                Unknown proof rule
            </xsl:otherwise>
        </xsl:choose>
        </li>
    </xsl:template>
    
    <xsl:template match="nonLoop" mode="nonterm">
        <xsl:param name="indent"/>
        <xsl:call-template name="nonLoop">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template match="nonLoop" mode="dpNonterm">
        <xsl:param name="indent"/>
        <xsl:call-template name="nonLoop">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template name="nonLoop">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Non-Loop</h3>
        <p>An infinite (possibly non-looping) derivation has been detected due to the following pattern rule.</p>
        <xsl:apply-templates select="patternRule"/>        
    </xsl:template>
    
    <xsl:template match="patternTerm">
        <xsl:apply-templates select="*[1]"/>
        <xsl:apply-templates select="*[2]"/><sup>n</sup>
        <xsl:apply-templates select="*[3]"/>
    </xsl:template>
    
    <xsl:template match="patternRule">
        <b><xsl:apply-templates select="patternTerm[1]"/> <xsl:value-of select="$arrow"/><sup>+</sup> <xsl:apply-templates select="patternTerm[2]"/></b><br/>
        <xsl:choose>
            <xsl:when test="narrowing">
                The pattern rule is obtained by narrowing the following two pattern rules.
                <ul>
                    <li><xsl:apply-templates select="narrowing/patternRule[1]"/></li>
                    <li><xsl:apply-templates select="narrowing/patternRule[2]"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="instantiation">
                The pattern rule is obtained by instantiating the following pattern rule.
                <ul>
                    <li><xsl:apply-templates select="instantiation/patternRule"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="rewriting">
                The pattern rule is obtained by rewriting the following pattern rule.
                <ul>
                    <li><xsl:apply-templates select="rewriting/patternRule"/></li>
                </ul>
            </xsl:when>
            <xsl:when test="originalRule">
                The pattern rule is obtained from the original rule
                <xsl:apply-templates select="originalRule/rule"/>                
            </xsl:when>
            <xsl:when test="instantiationPumping">
                The pattern rule is obtained by instantiating the following pattern rule.
                <ul>
                    <li><xsl:apply-templates select="instantiationPumping/patternRule"/></li>
                </ul>
            </xsl:when>            
            <xsl:when test="initialPumping">
                The pattern rule is obtained by adding an initial pumping substitution from
                <ul>
                    <li>
                        <xsl:apply-templates select="initialPumping/patternRule"/>   
                    </li>
                </ul>                
            </xsl:when>
            <xsl:when test="initialPumpingContext">
                The pattern rule is obtained by adding an initial pumping and ending substitution from
                <ul>
                    <li>
                        <xsl:apply-templates select="initialPumpingContext/patternRule"/>   
                    </li>
                </ul>                
            </xsl:when>
            <xsl:when test="equivalence">
                The pattern rule is equivalent to the following pattern rule
                <ul>
                    <li>
                        <xsl:apply-templates select="equivalence/patternRule"/>   
                    </li>
                </ul>                
            </xsl:when>
        </xsl:choose>
        
    </xsl:template>
    
    <xsl:template match="loop" mode="nonterm">
        <xsl:param name="indent"/>
        <xsl:variable name="context" select="count(box) = 0"/>
        <xsl:variable name="subst" select="count(substitution/substEntry) &gt; 0"/>
        <h3><xsl:value-of select="$indent"/> Loop</h3>
        The following loop proves nontermination.            
        <p>
            <xsl:apply-templates select="rewriteSequence"/>
            where t<sub><xsl:value-of select="count(rewriteSequence/rewriteStep)"/></sub> = 
            <xsl:if test="$context">C[</xsl:if>
            <xsl:text>t</xsl:text><sub>0</sub>
            <xsl:if test="$subst"><xsl:value-of select="$sigma"/></xsl:if>
            <xsl:if test="$context">]</xsl:if>
            <xsl:if test="$subst or $context">
                and
            </xsl:if>
            <xsl:if test="$subst">
                <xsl:value-of select="$sigma"/> = <xsl:apply-templates select="substitution"/>
            </xsl:if>
            <xsl:if test="$subst and $context">
                and
            </xsl:if>            
            <xsl:if test="$context">
                C = <xsl:apply-templates select="*[last()]"/>
            </xsl:if>
        </p>
    </xsl:template>
    
    <xsl:template match="loop" mode="dpNonterm">
        <xsl:param name="indent"/>
        <xsl:variable name="context" select="count(box) = 0"/>
        <xsl:variable name="subst" select="count(substitution/substEntry) &gt; 0"/>
        <h3><xsl:value-of select="$indent"/> Loop</h3>
        The following loop proves infiniteness of the DP problem.
        <p>
            <xsl:apply-templates select="rewriteSequence">
                <xsl:with-param name="strict">P</xsl:with-param>
                <xsl:with-param name="nonstrict">R</xsl:with-param>
            </xsl:apply-templates>
            where t<sub><xsl:value-of select="count(rewriteSequence/rewriteStep)"/></sub> = 
            <xsl:if test="$context">C[</xsl:if>
            <xsl:text>t</xsl:text><sub>0</sub>
            <xsl:if test="$subst"><xsl:value-of select="$sigma"/></xsl:if>
            <xsl:if test="$context">]</xsl:if>
            <xsl:if test="$subst or $context">
                and
            </xsl:if>
            <xsl:if test="$subst">
                <xsl:value-of select="$sigma"/> = <xsl:apply-templates select="substitution"/>
            </xsl:if>
            <xsl:if test="$subst and $context">
                and
            </xsl:if>            
            <xsl:if test="$context">
                C = <xsl:apply-templates select="*[last()]"/>
            </xsl:if>
        </p>
    </xsl:template>

    <xsl:template match="loop" mode="relNonterm">
        <xsl:param name="indent"/>
        <xsl:variable name="context" select="count(box) = 0"/>
        <xsl:variable name="subst" select="count(substitution/substEntry) &gt; 0"/>
        <h3><xsl:value-of select="$indent"/> Loop</h3>
        The following loop proves that R/S is not relative terminating. 
        <p>
            <xsl:apply-templates select="rewriteSequence">
                <xsl:with-param name="strict">R</xsl:with-param>
                <xsl:with-param name="nonstrict">S</xsl:with-param>
            </xsl:apply-templates>
            where t<sub><xsl:value-of select="count(rewriteSequence/rewriteStep)"/></sub> = 
            <xsl:if test="$context">C[</xsl:if>
            <xsl:text>t</xsl:text><sub>0</sub>
            <xsl:if test="$subst"><xsl:value-of select="$sigma"/></xsl:if>
            <xsl:if test="$context">]</xsl:if>
            <xsl:if test="$subst or $context">
                and
            </xsl:if>
            <xsl:if test="$subst">
                <xsl:value-of select="$sigma"/> = <xsl:apply-templates select="substitution"/>
            </xsl:if>
            <xsl:if test="$subst and $context">
                and
            </xsl:if>            
            <xsl:if test="$context">
                C = <xsl:apply-templates select="*[last()]"/>
            </xsl:if>
        </p>
    </xsl:template>
    
    <xsl:template match="notWNTreeAutomaton" mode="nonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Tree Automata based Nontermination</h3>
        The following nonempty tree automaton is closed under rewriting and does not accept normal forms.
        It hence proves nontermination and disproves weak normalization.
        <xsl:apply-templates select="treeAutomaton"/>
        <xsl:apply-templates select="criterion"/>
    </xsl:template>
    
    
    
    <xsl:template name="genVars">
        <xsl:param name="n"/>
        <xsl:choose>
            <xsl:when test="$n = 0"/>
            <xsl:when test="$n = 1">
                <xsl:text>(</xsl:text><span class="var">x<sub>1</sub></span><xsl:text>)</xsl:text>
            </xsl:when>
            <xsl:when test="$n = 2">
                <xsl:text>(</xsl:text><span class="var">x<sub>1</sub></span>, <span class="var">x<sub>2</sub></span><xsl:text>)</xsl:text>
            </xsl:when>
            <xsl:when test="$n = 3">
                <xsl:text>(</xsl:text><span class="var">x<sub>1</sub></span>, <span class="var">x<sub>2</sub></span>, <span class="var">x<sub>3</sub></span><xsl:text>)</xsl:text>
            </xsl:when>
            <xsl:otherwise>
                  <xsl:text>(</xsl:text><span class="var">x<sub>1</sub></span>,...,<span class="var">x<sub><xsl:value-of select="$n"/></sub></span><xsl:text>)</xsl:text>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

  <xsl:template match="variable">
	<xsl:variable name="vmode" select="'index'"/>
	<span class="var">
	  <xsl:choose>
		<xsl:when test="$vmode='index'">
		  <xsl:text>x</xsl:text>
		  <sub>
			<xsl:value-of select="./text()"/>
		  </sub>
		</xsl:when>
		<xsl:when test="$vmode='subscript'">
		  <xsl:text>x</xsl:text>
		  <sub>
			<xsl:apply-templates select="*"/>
		  </sub>
		</xsl:when>
		<xsl:otherwise>
		  <xsl:apply-templates select="*"/>
		</xsl:otherwise>
	  </xsl:choose>
	</span>
  </xsl:template>

  <xsl:template match="polynomial">
        <xsl:param name="inner">False</xsl:param>
        <xsl:choose>
            <xsl:when test="coefficient">
                <xsl:apply-templates select="coefficient"/>
            </xsl:when>
            <xsl:when test="variable">
			  <xsl:apply-templates select="variable"/>
			</xsl:when>
            <xsl:when test="sum">
                <xsl:if test="$inner = 'True'">
                    <xsl:text>(</xsl:text>                    
                </xsl:if>
                <xsl:for-each select="sum/polynomial">
                    <xsl:apply-templates select="."/>
                    <xsl:if test="position() != last()"> + </xsl:if>                    
                </xsl:for-each>
                <xsl:if test="$inner = 'True'">
                    <xsl:text>)</xsl:text>                    
                </xsl:if>
            </xsl:when>
            <xsl:when test="product">
                <xsl:for-each select="product/polynomial">
                    <xsl:apply-templates select=".">
                        <xsl:with-param name="inner">True</xsl:with-param>
                    </xsl:apply-templates>
                    <xsl:if test="position() != last()">
                      <xsl:text> </xsl:text>
                      <xsl:value-of select="$cdot"/>
                      <xsl:text> </xsl:text>
                    </xsl:if>                    
                </xsl:for-each>
            </xsl:when>
            <xsl:when test="max">
                <xsl:text>max(</xsl:text>
                <xsl:for-each select="max/polynomial">
                    <xsl:apply-templates select="."/>
                    <xsl:if test="position() != last()">,</xsl:if>                    
                </xsl:for-each>
                <xsl:text>)</xsl:text>
            </xsl:when>
            <xsl:when test="min">
                <xsl:text>min(</xsl:text>
                <xsl:for-each select="min/polynomial">
                    <xsl:apply-templates select="."/>
                    <xsl:if test="position() != last()">,</xsl:if>                    
                </xsl:for-each>
                <xsl:text>)</xsl:text>
            </xsl:when>
            <xsl:otherwise>unknown polynomial type</xsl:otherwise>
        </xsl:choose>
    </xsl:template>

	<xsl:template match="max">
		<xsl:text>max(</xsl:text>
		<xsl:for-each select="*">
    		<xsl:apply-templates select="."/>
			<xsl:if test="position() != last()">, </xsl:if>
		</xsl:for-each>
		<xsl:text>)</xsl:text>
	</xsl:template>
    
    <xsl:template match="integer">
        <xsl:value-of select="text()"/>
    </xsl:template>    

    <xsl:template match="algebraic">
        <xsl:variable name="firstnull" select="*[1]/text() = '0' or *[1]/numerator/text() = '0'"/>
        <xsl:variable name="secondnull" select="*[2]/text() = '0' or *[2]/numerator/text() = '0'"/>
        <xsl:variable name="secondone" select="*[2]/text() = '1' or (count(*[2]/numerator) &gt; 0 and *[2]/numerator/text() = *[2]/denominator/text())"/>
        <xsl:variable name="secondnegative" select="*[2]/text() &lt; 0 or (count(*[2]/numerator) &gt; 0 and *[2]/numerator/text() * *[2]/denominator/text() &lt; 0)"/>
        <xsl:variable name="brackets" select="not($firstnull) and not($secondnull)"/>
        <xsl:if test="$brackets">(</xsl:if>
        <xsl:if test="not($firstnull)">
            <xsl:apply-templates select="*[1]"/>
            <xsl:text> </xsl:text>
            <xsl:if test="not($secondnull) and not($secondnegative)">+ </xsl:if>
        </xsl:if>
        <xsl:if test="not($secondnull)">
            <xsl:if test="not($secondone)">
                <xsl:apply-templates select="*[2]"/>
                <xsl:text> </xsl:text>
                <xsl:value-of select="$cdot"/>
                <xsl:text> </xsl:text>
            </xsl:if>
            <xsl:text>sqrt(</xsl:text>
            <xsl:apply-templates select="*[3]"/>
            <xsl:text>)</xsl:text>
        </xsl:if>
        <xsl:if test="$brackets">)</xsl:if>
        <xsl:if test="$firstnull and $secondnull">0</xsl:if>
    </xsl:template>    
    
    <xsl:template match="rational">
        <xsl:value-of select="numerator/text()"/>
        <xsl:variable name="denom" select="denominator/text()"/>
        <xsl:if test="$denom != 1">
            <xsl:text>/</xsl:text>
            <xsl:value-of select="$denom"/>
        </xsl:if>        
    </xsl:template>    

    <xsl:template match="vector">
        <xsl:choose>
            <xsl:when test="count(coefficient) = 0">()</xsl:when>
            <xsl:otherwise>
                <table class="matrixbrak">
                    <tbody>
                        <tr>
                            <td class="lbrak"/>
                            <td>
                                <table class="matrix">
                                    <tbody>
                                        <xsl:for-each select="coefficient">
                                            <tr>
                                                <td>
                                                    <xsl:apply-templates select="."/>
                                                </td>
                                            </tr>
                                        </xsl:for-each>
                                    </tbody>
                                </table>
                            </td>
                            <td class="rbrak"/>
                        </tr>
                    </tbody>
                </table>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    <xsl:template match="matrix">
        <xsl:choose>
            <xsl:when test="count(vector) = 0">()</xsl:when>
            <xsl:otherwise>
                <table class="matrixbrak">
                    <tbody>
                        <tr>
                            <td class="lbrak"/>
                            <td><table class="matrix">
                                <tbody>
                                    <xsl:call-template name="matrix2">
                                        <xsl:with-param name="width" select="count(vector)"/>
                                        <xsl:with-param name="heigth" select="count(vector[1]/coefficient)"/>
                                        <xsl:with-param name="h" select="1"/>
                                    </xsl:call-template>
                                </tbody>                                
                            </table></td>
                            <td class="rbrak"/>
                        </tr>
                    </tbody>
                </table>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    <xsl:template name="matrix2">
        <xsl:param name="heigth"/>
        <xsl:param name="width"/>
        <xsl:param name="h"/>
        <tr>
            <xsl:call-template name="matrix3">
                <xsl:with-param name="width" select="$width"/>
                <xsl:with-param name="h" select="$h"/>                
                <xsl:with-param name="w" select="1"/>                
            </xsl:call-template>
        </tr>
        <xsl:if test="$h != $heigth">
            <xsl:call-template name="matrix2">
                <xsl:with-param name="heigth" select="$heigth"/>
                <xsl:with-param name="width" select="$width"/>
                <xsl:with-param name="h" select="$h + 1"/>
            </xsl:call-template>
        </xsl:if>
    </xsl:template>

    <xsl:template name="matrix3">
        <xsl:param name="width"/>
        <xsl:param name="h"/>
        <xsl:param name="w"/>
        <td>
            <xsl:apply-templates select="vector[$w]/coefficient[$h]"/>
        </td>
        <xsl:if test="$w != $width">
            <xsl:call-template name="matrix3">
                <xsl:with-param name="width" select="$width"/>
                <xsl:with-param name="w" select="$w + 1"/>
                <xsl:with-param name="h" select="$h"/>
            </xsl:call-template>
        </xsl:if>
    </xsl:template>
    
    <xsl:template match="coefficient">        
        <xsl:choose>
            <xsl:when test="integer">
                <xsl:apply-templates select="integer"/>
            </xsl:when>
            <xsl:when test="rational">
                <xsl:apply-templates select="rational"/>
            </xsl:when>
            <xsl:when test="algebraic">
                <xsl:apply-templates select="algebraic"/>
            </xsl:when>            
            <xsl:when test="minusInfinity">
                -<xsl:value-of select="$infty"/>
            </xsl:when>
            <xsl:when test="vector">
                <xsl:apply-templates select="vector"/>
            </xsl:when>
            <xsl:when test="matrix">
                <xsl:apply-templates select="matrix"/>                
            </xsl:when>
            <xsl:otherwise>
                unknown coefficient
            </xsl:otherwise>
        </xsl:choose>        
    </xsl:template>
    
    
    <xsl:template match="domain">
        <xsl:if test="naturals">the naturals</xsl:if>
        <xsl:if test="integers">the integers</xsl:if>
        <xsl:if test="arctic">the arctic semiring over <xsl:apply-templates select="arctic/domain"/></xsl:if>
        <xsl:if test="rationals">the rationals with delta = <xsl:apply-templates select="rationals/delta/*"/></xsl:if>
        <xsl:if test="algebraicNumbers">the algebraic numbers with delta = <xsl:apply-templates select="algebraicNumbers/delta/*"/></xsl:if>
        <xsl:if test="arcticBelowZero">the integers with -<xsl:value-of select="$infty"/> in the arctic semiring</xsl:if>
        <xsl:if test="matrices">(<xsl:value-of select="matrices/dimension/text()"/> x <xsl:value-of
        select="matrices/dimension/text()"/>)-matrices with strict dimension <xsl:value-of select="matrices/strictDimension/text()"/> 
            over <xsl:apply-templates
                select="matrices/domain"/>
        </xsl:if>
    </xsl:template>
    
    <xsl:template match="type">
        <!-- currently the strict dimensions are not displayed -->
        <xsl:choose>            
            <xsl:when test="polynomial">
                <xsl:if test="polynomial/degree/text() != 1">non-</xsl:if>
                <xsl:text>linear polynomial interpretation over </xsl:text>
                <xsl:apply-templates select="polynomial/domain"/>
            </xsl:when>
            <xsl:when test="matrixInterpretation">
                <xsl:text>matrix interpretations of dimension </xsl:text> 
                <xsl:value-of select="matrixInterpretation/dimension/text()"/>
                <xsl:text> with strict dimension </xsl:text> 
                <xsl:value-of select="matrixInterpretation/strictDimension/text()"/>
                <xsl:text> over </xsl:text>
                <xsl:apply-templates select="matrixInterpretation/domain"/>            
            </xsl:when>
            <xsl:otherwise>
                some unknown interpretation type
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    <xsl:template match="interpretation">
        <xsl:apply-templates select="*[1]"/>             
            <table>
                <xsl:attribute name="align">center</xsl:attribute>
                <xsl:for-each select="interpret">
                    <tr>
                        <td><xsl:attribute name="align">right</xsl:attribute>
                            <xsl:text>[</xsl:text><xsl:apply-templates select="*[1]"/><xsl:call-template name="genVars">
                                <xsl:with-param name="n" select="arity"/>
                            </xsl:call-template><xsl:text>]</xsl:text>
                        </td>
                        <td><xsl:attribute name="align">center</xsl:attribute> = </td>
                        <td><xsl:attribute name="align">left</xsl:attribute><xsl:apply-templates select="*[3]"/></td>
                    </tr>           
                </xsl:for-each>
            </table>                      
    </xsl:template>

	<xsl:template match="maxPoly">
	  <xsl:text>Max-polynomial interpretation</xsl:text>
		<table>
			<xsl:attribute name="align">center</xsl:attribute>
			<xsl:for-each select="interpret">
				<tr>
					<td>
						<xsl:attribute name="align">right</xsl:attribute>
						<xsl:text>[</xsl:text>
						<xsl:apply-templates select="*[1]"/>
						<xsl:call-template name="genVars">
							<xsl:with-param name="n" select="arity"/>
						</xsl:call-template>
						<xsl:text>]</xsl:text>
					</td>
					<td>
						<xsl:attribute name="align">center</xsl:attribute> =
					</td>
					<td>
						<xsl:attribute name="align">left</xsl:attribute>
						<xsl:apply-templates select="*[3]"/>
					</td>
				</tr>
			</xsl:for-each>
		</table>
	</xsl:template>

	<xsl:template match="pathOrder">
        <xsl:text>recursive path order with the following precedence and status</xsl:text>
        <xsl:apply-templates select="statusPrecedence"/>
        <xsl:if test="argumentFilter">
            in combination with the following argument filter 
            <xsl:apply-templates select="argumentFilter"/>
        </xsl:if>
    </xsl:template>
    
    <xsl:template match="multisetArgumentFilter">        
            <table>
                <xsl:for-each select="multisetArgumentFilterEntry">
                    <tr>
                        <td align="right">
                            <xsl:value-of select="$pi"/>(<xsl:apply-templates select="*[1]"/>)
                        </td>
                        <td align="center">=</td>
                        <td align="left">
                            {
                            <xsl:for-each select="status/position">
                                <xsl:if test="position() != 1">, </xsl:if>
                                <xsl:apply-templates select="."/>
                            </xsl:for-each>
                            }
                        </td>                                                
                    </tr>
                </xsl:for-each>
            </table>
        
    </xsl:template>
    
    
    <xsl:template match="statusPrecedence">
        <xsl:if test="count(statusPrecedenceEntry) != 0">
            <table align="center" width="100%">
                <xsl:for-each select="statusPrecedenceEntry">
                    <tr>
                        <td align="right">
                            <xsl:text>prec(</xsl:text>
                            <xsl:apply-templates select="*[1]"/>
                            <xsl:text>)</xsl:text>
                        </td>
                        <td align="center">=</td>
                        <td align="left">
                            <xsl:value-of select="precedence/text()"/>
                        </td>
                        <td/>
                        <td align="right">
                            <xsl:text>stat(</xsl:text>
                            <xsl:apply-templates select="*[1]"/>
                            <xsl:text>)</xsl:text>
                        </td>
                        <td align="center">=</td>
                        <td align="left">
                            <xsl:choose>
                                <xsl:when test="lex">
                                    lex
                                </xsl:when>
                                <xsl:when test="mul">
                                    mul
                                </xsl:when>
                                <xsl:otherwise>
                                    (unknown status)
                                </xsl:otherwise>
                            </xsl:choose>
                        </td>                        
                    </tr>
                </xsl:for-each>
            </table>
        </xsl:if>
    </xsl:template>

    <xsl:template match="weightedPathOrder">
        <xsl:text>Weighted Path Order with the following precedence and status</xsl:text>
        <xsl:apply-templates select="*[1]"/>
        <xsl:text>and the following 
        </xsl:text>
        <xsl:apply-templates select="*[2]"/>
    </xsl:template>

    <xsl:template match="filteredRedPair">
        <xsl:text>argument filter </xsl:text>
        <xsl:apply-templates select="*[1]"/>
        <xsl:text>in combination with the following </xsl:text>
        <xsl:apply-templates select="*[2]"/>
    </xsl:template>
    
    <xsl:template match="knuthBendixOrder">
        <xsl:text>Knuth Bendix order with w0 = </xsl:text>
        <xsl:value-of select="w0/text()"/>
        <xsl:text> and the following precedence and weight functions</xsl:text>
        <xsl:apply-templates select="precedenceWeight"/>
        <xsl:if test="argumentFilter">
            in combination with the following argument filter 
            <xsl:apply-templates select="argumentFilter"/>
        </xsl:if>
    </xsl:template>

    <xsl:template match="precedenceStatus">        
            <table align="center" width="100%">
                <xsl:for-each select="precedenceStatusEntry">
                    <tr>
                        <td align="right">
                            <xsl:text>prec(</xsl:text>
                            <xsl:apply-templates select="*[1]"/>
                            <xsl:text>)</xsl:text>
                        </td>
                        <td align="center">=</td>
                        <td align="left">
                            <xsl:value-of select="precedence/text()"/>
                        </td>
                        <td/>
                        <td align="right">
                            <xsl:text>status(</xsl:text>
                            <xsl:apply-templates select="*[1]"/>
                            <xsl:text>)</xsl:text>
                        </td>
                        <td align="center">=</td>
                        <td align="left">
                            <xsl:text>[</xsl:text>
                            <xsl:for-each select="status/*">
                                <xsl:if test="position() != 1">, </xsl:if>
                                <xsl:apply-templates select="."/>
                            </xsl:for-each>
                            <xsl:text>]</xsl:text>
                        </td>
                    </tr>
                </xsl:for-each>
            </table>        
    </xsl:template>
    
    
    <xsl:template match="precedenceWeight">
        <xsl:if test="count(precedenceWeightEntry) != 0">
            <table align="center" width="100%">
                <xsl:for-each select="precedenceWeightEntry">
                    <tr>
                        <td align="right">
                            <xsl:text>prec(</xsl:text>
                            <xsl:apply-templates select="*[1]"/>
                            <xsl:text>)</xsl:text>
                        </td>
                        <td align="center">=</td>
                        <td align="left">
                            <xsl:value-of select="precedence/text()"/>
                        </td>
                        <td/>
                        <td align="right">
                            <xsl:text>weight(</xsl:text>
                            <xsl:apply-templates select="*[1]"/>
                            <xsl:text>)</xsl:text>
                        </td>
                        <td align="center">=</td>
                        <td align="left">
                            <xsl:value-of select="weight/text()"/>
                        </td>
                        <xsl:choose>
                            <xsl:when test="subtermCoefficientEntries">
                                <td align="right">
                                    <xsl:text>subterm-coefficients(</xsl:text>
                                    <xsl:apply-templates select="*[1]"/>
                                    <xsl:text>)</xsl:text>
                                </td>
                                <td align="center">=</td>
                                <td align="left">
                                    <xsl:text>[</xsl:text>
                                    <xsl:for-each select="subtermCoefficientEntries/entry">
                                        <xsl:if test="position() != 1">, </xsl:if>
                                        <xsl:value-of select="./text()"/>
                                    </xsl:for-each>
                                    <xsl:text>]</xsl:text>
                                </td>                                
                            </xsl:when>
                            <xsl:otherwise>
                                <td/><td/><td/>
                            </xsl:otherwise>
                        </xsl:choose>
                        
                    </tr>
                </xsl:for-each>
            </table>
        </xsl:if>
    </xsl:template>
    
    <xsl:template match="levelMapping">
        <table align="center" width="100%">
            <xsl:for-each select="levelMappingEntry">
                <tr>
                    <td align="right">
                        <xsl:value-of select="$pi"/><xsl:text>(</xsl:text>
                        <xsl:apply-templates select="*[1]"/>
                        <xsl:text>)</xsl:text>
                    </td>
                    <td align="center">=</td>
                    <td align="left">
                        {
                        <xsl:for-each select="positionLevelEntry">
                            <xsl:if test="position() != 1">, </xsl:if>
                            <xsl:text>&lt;</xsl:text>
                            <xsl:variable name="p" select="position/text()"/>
                            <xsl:choose>
                                <xsl:when test="$p = '0'"><xsl:value-of select="$epsilon"/></xsl:when>
                                <xsl:otherwise><xsl:value-of select="$p"/></xsl:otherwise>
                            </xsl:choose>
                            <xsl:text>,</xsl:text>
                            <xsl:value-of select="level/text()"/>
                            <xsl:text>&gt;</xsl:text>
                        </xsl:for-each>
                        }
                    </td>
                </tr>
            </xsl:for-each>
        </table>        
    </xsl:template>
    
    <xsl:template match="scnp">
        SCNP-reduction pair with <xsl:value-of select="$mu"/> = 
        <xsl:choose>
            <xsl:when test="status/max">max</xsl:when>
            <xsl:when test="status/min">min</xsl:when>
            <xsl:when test="status/ms">ms</xsl:when>
            <xsl:when test="status/dms">dms</xsl:when>
            <xsl:otherwise>(unknown status)</xsl:otherwise>
        </xsl:choose>
        and level-mapping
        <xsl:apply-templates select="levelMapping"/>
        based on the reduction pair
        <xsl:apply-templates select="redPair"/>
    </xsl:template>
    
    <xsl:template match="redPair">
        <xsl:choose>
            <xsl:when test="interpretation">
                <xsl:apply-templates/>
            </xsl:when>
            <xsl:when test="pathOrder">
                <xsl:apply-templates/> 
            </xsl:when>
            <xsl:when test="knuthBendixOrder">
                <xsl:apply-templates/> 
            </xsl:when>            
            <xsl:when test="scnp">
                <xsl:apply-templates/>
            </xsl:when>
            <xsl:when test="weightedPathOrder">
                <xsl:apply-templates/>
            </xsl:when>
            <xsl:when test="filteredRedPair">
			  <xsl:apply-templates/>
			</xsl:when>
			<xsl:when test="maxPoly">
                <xsl:apply-templates/>
            </xsl:when>
            <xsl:otherwise>
                (unknown order)
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    <xsl:template match="dpTrans">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Dependency Pair Transformation</h3>
        <xsl:choose>
        <xsl:when test="count(dps/rules/rule) &gt; 0">
          The following set of initial dependency pairs has been identified.
          <xsl:apply-templates select="dps/*"/>
          <xsl:apply-templates select="dpProof">
              <xsl:with-param name="indent" select="concat($indent, '.1')"/>
          </xsl:apply-templates>
        </xsl:when>
        <xsl:otherwise>
          The set of initial dependency pairs is empty, and hence the TRS is
          terminating. 
        </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <xsl:template match="acTrivialProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> AC Dependency Pair Problem is trivial</h3>
        There are no strict pairs and rules remaining, or there are no DPs remaining. Therefore, finiteness is trivially satisfied.
    </xsl:template>
        
    
    <xsl:template match="acDependencyPairs">
        <xsl:param name="indent"/>
        <h3>
            <xsl:value-of select="$indent"/> AC Dependency Pair Transformation</h3>         
            <xsl:if test="count(equations/rules/rule) &gt; 0">
                The equational theory is encoded via the following rules,
                <xsl:apply-templates select="equations/*"/>
                resulting in the (weak) dependency pairs for the equational theory.
                <xsl:apply-templates select="dpEquations/*"/>
            </xsl:if>
            <xsl:choose>
                <xsl:when test="count(*) = 6">
                    <ul>
                        <li><p>The following set of (strict) dependency pairs is constructed for the TRS.
                            <xsl:apply-templates select="dps"/>
                            Finiteness for these DPs in combination with the equational DPs is proven as follows.
                            <xsl:apply-templates select="*[5]">
                                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
                            </xsl:apply-templates></p>
                        </li>
                        <xsl:if test="extensions/rules/*">
                            <li><p>The extended rules of the TRS
                                <xsl:apply-templates select="extensions"/>
                                give rise to another dependency pair problem.
                                Finiteness for these DPs in combination with the equational DPs is proven as follows.
                                <xsl:apply-templates select="*[6]">
                                    <xsl:with-param name="indent" select="concat($indent, '.2')"/>
                                </xsl:apply-templates></p>        
                            </li>
                        </xsl:if>
                    </ul>                    
                </xsl:when>
                <xsl:otherwise>
                    <p>The following set of (strict) dependency pairs is constructed for the TRS.
                        <xsl:apply-templates select="dps"/>
                        The extended rules of the TRS
                        <xsl:apply-templates select="extensions"/>
                        give rise to even more dependency pairs (by sharping the root symbols of each rule).
                        Finiteness for all DPs in combination with the equational DPs is proven as follows.
                        <xsl:apply-templates select="*[5]">
                            <xsl:with-param name="indent" select="concat($indent, '.1')"/>
                        </xsl:apply-templates></p>
                </xsl:otherwise>
            </xsl:choose>        
    </xsl:template>
    
    <xsl:template match="dpTrans" mode="nonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Dependency Pair Transformation</h3>
         The following set of initial dependency pairs has been identified.
         <xsl:apply-templates select="dps/rules"/>
        It remains to prove infiniteness of the resulting DP problem.
         <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
         </xsl:apply-templates>
    </xsl:template>
    
    
    
    <xsl:template match="unlabProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Unlabeling Processor</h3>
        After removing one layer of labels
        we obtain the set of pairs
        <xsl:apply-templates select="dps/*"/>
        and the set of rules        
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="*[3]">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="unravelingInformation">
        <table align="center">
            <xsl:for-each select="unravelingEntry">
                <tr><td>For </td><td colspan="3"><xsl:apply-templates select="conditionalRule"/> we get</td></tr>
                <xsl:for-each select="rule">
                <tr><td/>
                    <td align="right">
                        <xsl:apply-templates select="lhs"/>
                    </td>
                    <td align="center">
                        <xsl:value-of select="$arrow"/>
                    </td>
                    <td align="left">
                        <xsl:apply-templates select="rhs"/>
                    </td>                    
                </tr>
                </xsl:for-each>
                
            </xsl:for-each>
        </table>                
    </xsl:template>
    
    <xsl:template match="unraveling">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Unraveling</h3>
        <p>To prove that the CTRS is quasi-reductive, we show termination of the following 
            unraveled system.
        </p>
        <xsl:apply-templates select="unravelingInformation"/>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="unraveling" mode="cr">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Unraveling</h3>
        <p>To prove that the CTRS is confluent, we show confluence of the following 
            unraveled system.
        </p>
        <xsl:apply-templates select="unravelingInformation"/>
        <p>
            <xsl:apply-templates select="crProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    
    <xsl:template match="uncurriedSymbols">
        <xsl:param name="an" select="2"/>
        <p>
        <table align="center">
            <xsl:for-each select="uncurriedSymbolEntry">
                <xsl:variable name="n" select="arity"/>
                <tr><td><xsl:apply-templates select="*[1]"></xsl:apply-templates><xsl:call-template name="genVars">
                    <xsl:with-param name="n" select="$n"/>                    
                </xsl:call-template></td>
                    <td> is mapped to </td>
                    <xsl:for-each select="*">
                        <xsl:if test="position() > 2">
                            <td>
                                <xsl:apply-templates select="."></xsl:apply-templates><xsl:call-template name="genVars">
                                    <xsl:with-param name="n" select="$n + ($an - 1) * (position() - 3)"/>                    
                                </xsl:call-template><xsl:if test="position() != last()">, </xsl:if>
                            </td>
                        </xsl:if>
                    </xsl:for-each>
                </tr>
            </xsl:for-each>
        </table>
        </p>
    </xsl:template>
    
    <xsl:template match="uncurryInformation">
        <xsl:param name="an" select="2"/>
        <xsl:apply-templates select="*[1]"/>
        in combination with the following symbol map which also determines the applicative arities of these symbols.  
        <xsl:apply-templates select="uncurriedSymbols">
            <xsl:with-param name="an" select="$an"/>
        </xsl:apply-templates>        
        <br/>
        <xsl:choose>
            <xsl:when test="uncurryRules/rules/rule">
                The uncurry rules are:
                <xsl:apply-templates select="uncurryRules/*"/>                
            </xsl:when>
            <xsl:otherwise>
                There are no uncurry rules.
            </xsl:otherwise>
        </xsl:choose>
        <br/>
        <xsl:choose>
            <xsl:when test="etaRules/rules/rule">
                For the eta-expansion the following rules are added.
                <xsl:apply-templates select="etaRules/*"/>                
            </xsl:when>
            <xsl:otherwise>
                No rules have to be added for the eta-expansion.
            </xsl:otherwise>
        </xsl:choose>
        
    </xsl:template>

    <xsl:template match="uncurryProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Uncurrying Processor</h3>
        <p>We uncurry 
           <xsl:choose>
               <xsl:when test="applicativeTop">the tuple-symbol
                   <xsl:apply-templates select="uncurryInformation">
                       <xsl:with-param name="an" select="applicativeTop/text()"/>                                                 
                   </xsl:apply-templates>
               </xsl:when>
               <xsl:otherwise>the binary symbol 
                   <xsl:apply-templates select="uncurryInformation"/>
               </xsl:otherwise>
           </xsl:choose>            
        </p>
        
        Uncurrying the pairs and rules, and adding the uncurrying rules yields the pair(s)
        <xsl:apply-templates select="dps/*"/>
        and the set of rules        
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="uncurry">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Uncurrying</h3>
        <p>We uncurry the binary symbol  
            <xsl:apply-templates select="uncurryInformation"/>
        </p>
        
        Uncurrying the rules and adding the uncurrying rules yields the new set of rules
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="uncurry" mode="nonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Uncurrying</h3>
        <p>We uncurry the binary symbol  
            <xsl:apply-templates select="uncurryInformation"/>
        </p>
        
        Uncurrying the rules and adding the uncurrying rules yields the new set of rules
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="uncurry" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Uncurrying</h3>
        <p>We uncurry the binary symbol  
            <xsl:apply-templates select="uncurryInformation"/>
        </p>
        
        Uncurrying the rules and adding the uncurrying rules yields the new set of rules
        <xsl:apply-templates select="*[2]/*"/>
        and
        <xsl:apply-templates select="*[3]/*"/>        
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="permutingArgumentFilter">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Permuting Argument Filter</h3>
        <p>We permute some arguments by the following argument filter.  
            <xsl:apply-templates select="argumentFilter"/>
        </p>
        
        Afterwards termination of the resulting TRS is proven.
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>    

    <xsl:template match="permutingArgumentFilter" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Permuting Argument Filter</h3>
        <p>We permute some arguments by the following argument filter.  
            <xsl:apply-templates select="argumentFilter"/>
        </p>
        
        Afterwards relative termination of the resulting TRSs is proven.
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>    
    
    
    <xsl:template match="split">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Split</h3>
        <p>We split R in the relative problem D/R-D and R-D, where the rules D
            <xsl:apply-templates select="trs/*"/>
            are deleted.
        </p>
        <p>
            <xsl:apply-templates select="trsTerminationProof[1]">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
        <p>
            <xsl:apply-templates select="trsTerminationProof[2]">
                <xsl:with-param name="indent" select="concat($indent, '.2')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="split" mode="complexity">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Split</h3>
        <p>We split S<sub>1</sub> <xsl:value-of select="$union"/> S<sub>2</sub> / W into the problems 
            S<sub>1</sub> / S<sub>2</sub> <xsl:value-of select="$union"/> W 
            and S<sub>2</sub> / S<sub>1</sub> <xsl:value-of select="$union"/> W
            where S<sub>1</sub> is the TRS
            <xsl:apply-templates select="trs/*"/>
        </p>
        <p>
            <xsl:apply-templates select="complexityProof[1]">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
        <p>
            <xsl:apply-templates select="complexityProof[2]">
                <xsl:with-param name="indent" select="concat($indent, '.2')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="splitProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Split</h3>
        <p>We split (P,R) into the relative DP-problem (PD,P-PD,RD,R-RD) and (P-PD,R-RD) where the pairs PD
            <xsl:apply-templates select="dps/*"/>
            and the rules RD
            <xsl:apply-templates select="trs/*"/>            
            are deleted.
        </p>
        <p>
            <xsl:apply-templates select="dpProof[1]">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
        <p>
            <xsl:apply-templates select="dpProof[2]">
                <xsl:with-param name="indent" select="concat($indent, '.2')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    
    <xsl:template match="state">
        <xsl:apply-templates/>
    </xsl:template>
    
    <xsl:template match="treeAutomaton">
        <ul>
            <li><p>final states:</p>
                <p><xsl:text>{</xsl:text>
                    <xsl:for-each select="finalStates/*">
                        <xsl:if test="position() != 1">, </xsl:if>
                        <xsl:apply-templates select="."/>
                    </xsl:for-each>
                    <xsl:text>}</xsl:text>
                </p>
            </li>
            <li>
                <p>transitions:</p>
                <p>
                    <table>
                        <xsl:for-each select="transitions/transition">
                            <tr>
                                <td align="right">
                                    <xsl:apply-templates select="lhs/*[1]"/>
                                    <xsl:if test="lhs/height">
                                        <sub><xsl:apply-templates select="lhs/height"/></sub>                                        
                                    </xsl:if>
                                    <xsl:if test="count(lhs/*) != 1">
                                        <xsl:for-each select="lhs/state">
                                            <xsl:choose>
                                                <xsl:when test="position()=1">(</xsl:when>
                                                <xsl:otherwise>,</xsl:otherwise>
                                            </xsl:choose>
                                            <xsl:apply-templates select="."/>                                        
                                            <xsl:if test="position()=last()">)</xsl:if>
                                    </xsl:for-each>
                                    </xsl:if>
                                </td>
                                <td><xsl:value-of select="$rewrite"/></td>
                                <td align="left"><xsl:apply-templates select="rhs/state"/></td>
                            </tr>
                        </xsl:for-each>
                    </table>
                </p>
            </li>
        </ul>
    </xsl:template>
    
    <xsl:template match="removeNonApplicableRules">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Removal of non-applicable rules</h3>
        The following rules have arguments which are not in normal form. Due to the strategy restrictions these can be removed.                
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="removeNonApplicableRules" mode="complexity">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Removal of non-applicable rules</h3>
        The following rules have arguments which are not in normal form. Due to the strategy restrictions these can be removed.                
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="complexityProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>            
        </p>
    </xsl:template>  

    <xsl:template match="usableRules" mode="complexity">
        <xsl:param name="indent"/>        
        <h3><xsl:value-of select="$indent"/> Usable Rules</h3>
        We remove the following rules since they are not usable.
        <xsl:apply-templates select="nonUsableRules"/>
        <xsl:apply-templates select="complexityProof">
            <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>            
    </xsl:template>    
    
    <xsl:template match="dtTransformation" mode="complexity">
        <xsl:param name="indent"/>        
        <h3><xsl:value-of select="$indent"/> Dependency Tuples</h3>
        We get the following set of dependency tuples:
        <table align="center">
            <xsl:for-each select="*/ruleWithDT">
            <tr>
                <td><xsl:apply-templates select="*[2]"/></td>
                <td> originates from </td>
                <td><xsl:apply-templates select="*[1]"/></td>
            </tr>     
            </xsl:for-each>            
        </table> 
        Moreover, we add the following terms to the innermost strategy.
        <xsl:apply-templates select="innermostLhss"/>
        <xsl:apply-templates select="complexityProof">
            <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>            
    </xsl:template>    

    <xsl:template match="wdpTransformation" mode="complexity">
        <xsl:param name="indent"/>        
        <h3><xsl:value-of select="$indent"/> Weak Dependency Pairs</h3>
        We get the following set of weak dependency pairs:
        <table align="center">
            <xsl:for-each select="*/ruleWithWDP">
                <tr>
                    <td><xsl:apply-templates select="*[2]"/></td>
                    <td> originates from </td>
                    <td><xsl:apply-templates select="*[1]"/></td>
                </tr>     
            </xsl:for-each>            
        </table> 
        Moreover, we add the following terms to the innermost strategy.
        <xsl:apply-templates select="innermostLhss"/>
        <xsl:apply-templates select="complexityProof">
            <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>            
    </xsl:template>    
    
    <xsl:template match="relativeBounds" mode="complexity">
        <xsl:param name="indent"/>        
        <h3><xsl:value-of select="$indent"/> Relative Match-Bounds</h3>
        Considering the strict rules 
        <xsl:apply-templates select="trs"/>
        the relative termination problem is 
        match-(raise)-bounded by 
        <xsl:for-each select="bounds[1]">
            <xsl:apply-templates select="bound"/>.
            This is shown by the following automaton.
            <xsl:call-template name="compatibleTreeAutomaton"/>
        </xsl:for-each>
        <xsl:apply-templates select="complexityProof">
           <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>            
    </xsl:template>

    <xsl:template match="bounds" mode="complexity">
        <xsl:param name="indent"/>        
        <xsl:apply-templates select=".">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="bounds">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Bounds</h3>
        The given TRS is 
        <xsl:choose>
            <xsl:when test="type/roof">roof</xsl:when>
            <xsl:when test="type/match">match</xsl:when>
        </xsl:choose>
        <xsl:text>-(raise)-bounded by </xsl:text>
        <xsl:apply-templates select="bound"/>.
        This is shown by the following automaton.
        <xsl:call-template name="compatibleTreeAutomaton"/>
    </xsl:template>
    
    <xsl:template match="unlab">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Unlabeling</h3>
        After removing one layer of labels
        we obtain the TRS  
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="unlab" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Unlabeling</h3>
        After removing one layer of labels
        we obtain the TRSs R:       
        <xsl:apply-templates select="*[1]/*"/>
        and S:
        <xsl:apply-templates select="*[2]/*"/>
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="constantToUnary">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Constant to Unary</h3>
        Every constant is turned into a unary function symbol to obtain the TRS        
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="constantToUnary" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Constant to Unary</h3>
        Every constant is turned into a unary function symbol to obtain the TRSs        
        <xsl:apply-templates select="trs[1]/*"/>
        and 
        <xsl:apply-templates select="trs[2]/*"/>
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    
    <xsl:template match="constantToUnary" mode="nonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Constant to Unary</h3>
        Every constant is turned into a unary function symbol to obtain the TRS        
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="stringReversal" mode="nonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> String Reversal</h3>
        Since only unary symbols occur, one can reverse all terms and obtains the TRS        
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="stringReversal" mode="relNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> String Reversal</h3>
        Since only unary symbols occur, one can reverse all terms and obtains the TRSs        
        <xsl:apply-templates select="trs[1]/*"/>
        and 
        <xsl:apply-templates select="trs[2]/*"/>
        <p>
            <xsl:apply-templates select="relativeNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>    
    
    
    <xsl:template match="stringReversal">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> String Reversal</h3>
        Since only unary symbols occur, one can reverse all terms and obtains the TRS        
        <xsl:apply-templates select="trs/*"/>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="stringReversal" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> String Reversal</h3>
        Since only unary symbols occur, one can reverse all terms and obtains the TRS  R:
        <xsl:apply-templates select="*[1]/*"/>
        and S:
        <xsl:apply-templates select="*[2]/*"/>
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="semlab">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Semantic Labeling</h3>
        <xsl:apply-templates select="model"/>
        We obtain the labeled TRS
        <xsl:apply-templates select="trs/*"/>
        <xsl:apply-templates select="innermostLhss" mode="optional"/>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="semlab" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Semantic Labeling</h3>
        <xsl:apply-templates select="model"/>
        We obtain the labeled TRS R:
        <xsl:apply-templates select="*[2]/*"/>
        and S:
        <xsl:apply-templates select="*[3]/*"/>
        <xsl:apply-templates select="innermostLhss" mode="optional"/>
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="flatContexts">
      <p>
      {<xsl:for-each select="*">
        <xsl:apply-templates select="."/>
        <xsl:if test="last() != position()">, </xsl:if>
      </xsl:for-each>}
      </p>
    </xsl:template>

    <xsl:template match="flatContextClosure">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Closure Under Flat Contexts</h3>
      Using the flat contexts
      <xsl:apply-templates select="flatContexts"/>
      We obtain the transformed TRS
      <xsl:apply-templates select="trs/*"/>
      <p>
        <xsl:apply-templates select="*[3]">
          <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
      </p>
    </xsl:template>

    <xsl:template match="flatContextClosure" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Closure Under Flat Contexts</h3>
        Using the flat contexts
        <xsl:apply-templates select="flatContexts"/>
        We obtain the transformed TRSs
        <xsl:apply-templates select="*[2]"/>
        and 
        <xsl:apply-templates select="*[3]"/>
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="freshSymbol">
      <xsl:apply-templates/>
    </xsl:template>

    <xsl:template match="flatContextClosureProc">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Closure Under Flat Contexts</h3>
      Using
      <!--
      the fresh function symbol
      <xsl:apply-templates select="freshSymbol"/>
      and
      -->
      the flat contexts
      <xsl:apply-templates select="flatContexts"/>
      We obtain the set of pairs
      <xsl:apply-templates select="dps/*"/>
      and the rules:
      <xsl:apply-templates select="trs/*"/>
      <p>
        <xsl:apply-templates select="*[5]">
          <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>
      </p>
    </xsl:template>
    
    <xsl:template match="semlabProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Semantic Labeling Processor</h3>
        <xsl:apply-templates select="model"/>
        We obtain the set of labeled pairs
        <xsl:apply-templates select="dps/*"/>
        and the set of labeled rules:        
        <xsl:apply-templates select="trs/*"/>
        <xsl:apply-templates select="innermostLhss" mode="optional"/>
        <p>
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="usableRulesProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Usable Rules Processor</h3>
        <p>We restrict the rewrite rules to the following usable rules of the DP problem.</p> 
        <xsl:apply-templates select="usableRules/*"/>        
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        
    </xsl:template>
    
    <xsl:template match="innermostLhssRemovalProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Innermost Lhss Removal Processor</h3>
        <p>We restrict the innermost strategy to the following left hand sides.</p>
        <xsl:apply-templates select="innermostLhss"/>        
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>        
    </xsl:template>
    
    <xsl:template mode="dpNonterm" match="innermostLhssRemovalProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Innermost Lhss Removal Processor</h3>
        <p>We restrict the innermost strategy to the following left hand sides.</p>
        <xsl:apply-templates select="innermostLhss"/>        
            <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>        
    </xsl:template>

    <xsl:template mode="dpNonterm" match="innermostLhssIncreaseProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Innermost Lhss Increase Processor</h3>
        We add the following left hand sides to the innermost strategy.
        <xsl:apply-templates select="innermostLhss"/>
        <p>
            <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template mode="dpNonterm" match="switchFullStrategyProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Full Strategy Switch Processor</h3>
        We have a locally confluent overlay TRS, no overlaps between P and R,
        and the strategy is less than innermost. Hence, it suffices to prove non-termination for the
        full rewrite relation.
        <xsl:apply-templates select="wcrProof"/>
        <p>
            <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template mode="nonterm" match="switchFullStrategy">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Full Strategy Switch</h3>
        We have a locally confluent overlay TRS
        and the strategy is less than innermost. Hence, it suffices to prove non-termination for the
        full rewrite relation.
        <xsl:apply-templates select="wcrProof"/>
        <p>
            <xsl:apply-templates select="trsNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template mode="nonterm" match="innermostLhssIncrease">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Innermost Lhss Increase</h3>
        We add the following left hand sides to the innermost strategy.
        <xsl:apply-templates select="innermostLhss"/>
        <p>
            <xsl:apply-templates select="trsNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>    
    
    
    <xsl:template match="rewritingProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Rewriting Processor</h3>
        We rewrite the right hand side of the pair  
        <xsl:apply-templates select="rule[1]" mode="centered"/>
        resulting in 
        <table align="center">            
            <tr>
                <td><xsl:apply-templates select="rule[last()]/lhs"/></td>
                <td><xsl:value-of select="$rewrite"/></td>
                <td><xsl:apply-templates select="rule[last()]/rhs"/></td>                        
            </tr>
        </table>        
        <p>
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="rewritingProc" mode="dpNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Rewriting Processor</h3>
        We rewrite the right hand side of the pair  
        <xsl:apply-templates select="rule[1]" mode="centered"/>
        resulting in 
        <table align="center">            
            <tr>
                <td><xsl:apply-templates select="rule[last()]/lhs"/></td>
                <td><xsl:value-of select="$rewrite"/></td>
                <td><xsl:apply-templates select="rule[last()]/rhs"/></td>                        
            </tr>
        </table>        
        <p>
            <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    
    <xsl:template match="instantiationProc">
        <xsl:param name="indent"/>
        <xsl:call-template name="instantiationProc">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>

    <xsl:template match="forwardInstantiationProc">
        <xsl:param name="indent"/>
        <xsl:call-template name="instantiationProc">
            <xsl:with-param name="indent" select="$indent"/>
            <xsl:with-param name="prefix">Forward</xsl:with-param>
        </xsl:call-template>        
    </xsl:template>
    
    <xsl:template name="instantiationProc">
        <xsl:param name="indent"/>
        <xsl:param name="prefix"/>
        <h3><xsl:value-of select="$indent"/><xsl:value-of select="concat(' ',$prefix)"/> Instantiation Processor</h3>
        We instantiate the pair  
        <xsl:apply-templates select="rule" mode="centered"/>
        to the following set of pairs
        <xsl:apply-templates select="instantiations/rules"/>
        <p>
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="instantiationProc" mode="dpNonterm">
        <xsl:param name="indent"/>
        <xsl:param name="prefix"/>
        <h3><xsl:value-of select="$indent"/><xsl:value-of select="concat(' ',$prefix)"/> Instantiation Processor</h3>
        The pairs are instantiated to the following pairs.
        <xsl:apply-templates select="dps/rules"/>
        <p>
            <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="narrowingProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Narrowing Processor</h3>
        We consider all narrowings of the pair 
        <xsl:apply-templates select="rule" mode="centered"/>
        below position 
        <xsl:apply-templates select="positionInTerm"/>
        to get the following set of pairs
        <xsl:apply-templates select="narrowings/rules"/>
        <p>
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="narrowingProc" mode="dpNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Narrowing Processor</h3>
        We consider narrowings of the pair 
        <xsl:apply-templates select="rule" mode="centered"/>
        below position 
        <xsl:apply-templates select="positionInTerm"/>
        to get the following set of pairs
        <xsl:apply-templates select="narrowings/rules"/>
        <p>
            <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    
    <xsl:template match="complexConstantRemovalProc">
        <xsl:param name="indent"/>
        <xsl:param name="prefix"/>
        <h3><xsl:value-of select="$indent"/><xsl:value-of select="concat(' ',$prefix)"/> Complex Constant Removal Processor</h3>
        We replace the term 
        <xsl:apply-templates select="*[1]"/> by a fresh variable. This results in the following new pairs.
        <p>
            <table>
                <xsl:attribute name="align">center</xsl:attribute>
                <xsl:for-each select="ruleMap/ruleMapEntry">
                    <tr>
                        <td align="right">
                            <xsl:apply-templates select="rule[2]/lhs"/>
                        </td>
                        <td align="center">
                            <xsl:value-of select="$arrow"/>
                        </td>
                        <td align="left">
                            <xsl:apply-templates select="rule[2]/rhs"/>
                        </td>
                    </tr>
                </xsl:for-each>
            </table>            
        </p>
        <p>
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="arithFunction">
        <xsl:apply-templates select="*[1]" mode="arithFun"/>
    </xsl:template>
    
    <xsl:template mode="arithFun" match="number">
        <xsl:apply-templates/>
    </xsl:template>

    <xsl:template mode="arithFun" match="variable">
        <span class="var">x<sub><xsl:apply-templates/></sub></span>
    </xsl:template>

    <xsl:template mode="arithFun" match="sum">
        <xsl:for-each select="*">
            <xsl:apply-templates select="."/>
            <xsl:if test="position() != last()"> + </xsl:if>
        </xsl:for-each>
    </xsl:template>

    <xsl:template mode="arithFun" match="prod">
        <xsl:text>(</xsl:text>
        <xsl:for-each select="*">
            <xsl:apply-templates select="."/>
            <xsl:if test="position() != last()"> * </xsl:if>
        </xsl:for-each>
        <xsl:text>)</xsl:text>        
    </xsl:template>
    
    <xsl:template mode="arithFun" match="min">
        <xsl:text>min(</xsl:text>
        <xsl:for-each select="*">
            <xsl:apply-templates select="."/>
            <xsl:if test="position() != last()">,</xsl:if>
        </xsl:for-each>
        <xsl:text>)</xsl:text>
    </xsl:template>

    <xsl:template mode="arithFun" match="max">
        <xsl:text>max(</xsl:text>
        <xsl:for-each select="*">
            <xsl:apply-templates select="."/>
            <xsl:if test="position() != last()">,</xsl:if>
        </xsl:for-each>
        <xsl:text>)</xsl:text>
    </xsl:template>

    <xsl:template mode="arithFun" match="ifEqual">
        <xsl:text>(if </xsl:text>
        <xsl:apply-templates select="*[1]"/>
        <xsl:text> = </xsl:text>
        <xsl:apply-templates select="*[2]"/>
        <xsl:text> then </xsl:text>
        <xsl:apply-templates select="*[3]"/>
        <xsl:text> else </xsl:text>
        <xsl:apply-templates select="*[4]"/>
        <xsl:text>)</xsl:text>
    </xsl:template>
    
    <xsl:template match="model">
        <xsl:apply-templates/>
    </xsl:template>
    
    <xsl:template match="rootLabeling">
        <p>
            <xsl:text>Root-labeling is applied</xsl:text>
            <xsl:if test="count(*) = 1">
                <xsl:text> with a special treatment of the blocking symbol </xsl:text>
                <xsl:apply-templates/>
            </xsl:if>
            <xsl:text>.</xsl:text>
        </p>
    </xsl:template>
    
    <xsl:template match="finiteModel">
        The following interpretations form a 
        <xsl:choose>
            <xsl:when test="tupleOrder">
                quasi-model 
            </xsl:when>
            <xsl:otherwise>
                model
            </xsl:otherwise>
        </xsl:choose>
            of the rules.
            <xsl:if test="tupleOrder">
                (Here, the order is 
                <xsl:choose>
                    <xsl:when test="tupleOrder/pointWise">
                        the pointwise extension of > to vectors over natural numbers)
                    </xsl:when>
                </xsl:choose>                
            </xsl:if>
        <p>
          As carrier we take the set 
          <xsl:choose>
              <xsl:when test="carrierSize/text() = 1">{0}</xsl:when>
              <xsl:when test="carrierSize/text() = 2">{0,1}</xsl:when>
              <xsl:when test="carrierSize/text() = 3">{0,1,2}</xsl:when>
              <xsl:otherwise>{0,...,<xsl:value-of select="carrierSize/text() - 1"/>}</xsl:otherwise>
          </xsl:choose>
          <xsl:text>.</xsl:text>
	  Symbols are labeled by the interpretation of their arguments using the interpretations
          (modulo <xsl:value-of select="carrierSize/text()"/>):
          <p>
              <table>
                  <xsl:attribute name="align">center</xsl:attribute>
                  <xsl:for-each select="interpret">
                      <tr>
                          <td><xsl:attribute name="align">right</xsl:attribute>
                              <xsl:text>[</xsl:text><xsl:apply-templates select="*[1]"/><xsl:call-template name="genVars">
                                  <xsl:with-param name="n" select="arity"/>
                              </xsl:call-template><xsl:text>]</xsl:text>
                          </td>
                          <td><xsl:attribute name="align">center</xsl:attribute> = </td>
                          <td><xsl:attribute name="align">left</xsl:attribute><xsl:apply-templates select="arithFunction"/></td>
                      </tr>           
                  </xsl:for-each>
                  <!--
                  <tr>
                      <td><xsl:attribute name="align">right</xsl:attribute>
                          <xsl:text>[f(</xsl:text><span class="var">x<sub>1</sub></span>,...,<span class="var">x<sub>n</sub></span>)]
                      </td>
                      <td><xsl:attribute name="align">center</xsl:attribute> = </td>
                      <td><xsl:attribute name="align">left</xsl:attribute>
                          0 
                      </td>
                      <td><xsl:attribute name="align">right</xsl:attribute>
                          for all other symbols f of arity n
                      </td>                            
                  </tr>
                  -->
              </table>          
              </p>
        </p>
    </xsl:template>
    
    <xsl:template name="NegatedProofStep">
      <xsl:param name="indent"/>
      <xsl:param name="name"/>
      <xsl:param name="justification"/>
      <xsl:param name="pairs"/>
      <xsl:param name="urules">null</xsl:param>        
      <xsl:param name="rules">null</xsl:param>
      <xsl:param name="proof"/>
        Using the <xsl:value-of select="$name"/>
      <xsl:apply-templates select="$justification"/>
        <xsl:if test="string($urules) != 'null'">
            <xsl:choose>
                <xsl:when test="count($urules) &gt; 0">
                    together with the usable
                    rule<xsl:if test="count($urules) &gt; 1">s</xsl:if>
                    <xsl:apply-templates select="$urules/.."/>
                    (w.r.t. the implicit argument filter of the reduction pair),
                </xsl:when>
                <xsl:otherwise>
                    having no usable rules (w.r.t. the implicit argument filter of the
                    reduction pair),
                </xsl:otherwise>
            </xsl:choose>
        </xsl:if>        
      <xsl:choose>
        <xsl:when test="count($pairs) &gt; 0">
          the
          pair<xsl:if test="count($pairs) &gt; 1">s</xsl:if> 
          <xsl:apply-templates select="$pairs/.."/>
	  <xsl:if test="string($rules) != 'null'">
	    and
            <xsl:choose>
              <xsl:when test="count($rules) &gt; 0">
                the
                rule<xsl:if test="count($rules) &gt; 1">s</xsl:if>
                <xsl:apply-templates select="$rules/.."/>
              </xsl:when>
              <xsl:otherwise>
                no rules
              </xsl:otherwise>
            </xsl:choose>
	  </xsl:if>
          could be deleted.
        </xsl:when>
        <xsl:otherwise>
              the
              rule<xsl:if test="count($rules) &gt; 1">s</xsl:if>
              <xsl:apply-templates select="$rules/.."/>
              could be deleted.	  
        </xsl:otherwise>
      </xsl:choose>
      
        <xsl:apply-templates select="$proof">
          <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
      
    </xsl:template>

    <xsl:template name="ProofStep">
        <xsl:param name="indent"/>
        <xsl:param name="name"/>
        <xsl:param name="justification"/>
        <xsl:param name="pairs"/>
        <xsl:param name="urules">null</xsl:param>
        <xsl:param name="rules">null</xsl:param>
        <xsl:param name="proof"/>
        Using the <xsl:value-of select="$name"/>
        <xsl:apply-templates select="$justification"/>
        <xsl:if test="string($urules) != 'null'">
            <xsl:choose>
                <xsl:when test="count($urules) &gt; 0">
                    together with the usable
                    rule<xsl:if test="count($urules) &gt; 1">s</xsl:if>
                    <xsl:apply-templates select="$urules/.."/>
                    (w.r.t. the implicit argument filter of the reduction pair),
                </xsl:when>
                <xsl:otherwise>
                    having no usable rules (w.r.t. the implicit argument filter of the
                    reduction pair),
                </xsl:otherwise>
            </xsl:choose>
        </xsl:if>
        <xsl:choose>
            <xsl:when test="count($pairs) &gt; 0">
                the
                pair<xsl:if test="count($pairs) &gt; 1">s</xsl:if> 
                <xsl:apply-templates select="$pairs/.."/>
                <xsl:if test="string($rules) != 'null'">
                    and
                    <xsl:choose>
                        <xsl:when test="count($rules) &gt; 0">
                            the
                            rule<xsl:if test="count($rules) &gt; 1">s</xsl:if>
                            <xsl:apply-templates select="$rules/.."/>
                        </xsl:when>
                        <xsl:otherwise>
                            no rules
                        </xsl:otherwise>
                    </xsl:choose>
                </xsl:if>
                remain<xsl:if test="count($pairs) = 1 and string($rules) = 'null'">s</xsl:if>.
            </xsl:when>
            <xsl:otherwise>
                <xsl:choose>
                    <xsl:when test="string($rules) != 'null' and count($rules) &gt; 0">
                        all pairs could be removed, but the
                        rule<xsl:if test="count($rules) &gt; 1">s</xsl:if>
                        <xsl:apply-templates select="$rules/.."/>
                        remain<xsl:if test="count($rules) &gt; 1">s</xsl:if>.
                    </xsl:when>
                    <xsl:when test="string($rules) != 'null'">
                        all pairs and rules could be removed.
                    </xsl:when>
                    <xsl:otherwise>
                        all pairs could be removed.
                    </xsl:otherwise>
                </xsl:choose>
            </xsl:otherwise>
        </xsl:choose>
        
        <xsl:apply-templates select="$proof">
            <xsl:with-param name="indent" select="concat($indent,'.1')"/>
        </xsl:apply-templates>
        
    </xsl:template>
    
    <xsl:template match="argumentFilter">
          <p>
          <table>
              <xsl:for-each select="argumentFilterEntry">
          <tr>
            <td align="right"><xsl:value-of select="$pi"/>(<xsl:apply-templates select="*[1]"/>)</td>
            <td align="center">=</td>
            <td align="left">
                <xsl:choose>
                    <xsl:when test="collapsing">
                        <xsl:value-of select="collapsing"/>                        
                    </xsl:when>
                    <xsl:when test="nonCollapsing">
                        <xsl:text>[</xsl:text>
                        <xsl:for-each select="nonCollapsing/position">
                            <xsl:apply-templates/>
                            <xsl:if test="position() != last()">
                                <xsl:text>,</xsl:text>
                            </xsl:if>
                        </xsl:for-each>
                        <xsl:text>]</xsl:text>
                    </xsl:when>
                    <xsl:otherwise>
                        <xsl:message terminate="yes">unknown argument filter entry</xsl:message>                        
                    </xsl:otherwise>                    
                </xsl:choose>                
            </td>
          </tr>
          </xsl:for-each>
          </table>
          </p>
    </xsl:template>

    <xsl:template match="projectedRewriteSequence">
      <li>
      the projected left-hand side of the rule
      <p>
      <xsl:apply-templates select="rule"/>
      </p>
      is rewritten according to
      <xsl:apply-templates select="rewriteSequence"/>
      </li>
    </xsl:template>
    
    <xsl:template match="subtermProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Subterm Criterion Processor</h3>
        <xsl:choose>
            <xsl:when test="argumentFilter">
                We use the projection
                <xsl:apply-templates select="argumentFilter"/>
                <xsl:choose>
                    <xsl:when test="count(projectedRewriteSequence) &gt; 0">
                        and the following rewrite sequences:
                        <p>
                            <ul>
                                <xsl:apply-templates select="projectedRewriteSequence"/>
                            </ul>
                        </p>
                    </xsl:when>
                </xsl:choose>
                <xsl:choose>
                    <xsl:when test="count(dps/rules/*) &gt; 0">
                        and remain with the pairs:
                        <xsl:apply-templates select="dps/*"/>
                    </xsl:when>
                    <xsl:otherwise>
                        to remove all pairs.
                    </xsl:otherwise>
                </xsl:choose>
                <xsl:apply-templates select="dpProof">
                    <xsl:with-param name="indent" select="concat($indent, '.1')"/>
                </xsl:apply-templates>                
            </xsl:when>
            <xsl:otherwise>
                We use the projection to multisets 
                <xsl:apply-templates select="multisetArgumentFilter"/>
                to remove the pairs:
                <xsl:apply-templates select="dps/*"/>
                <xsl:apply-templates select="dpProof">
                    <xsl:with-param name="indent" select="concat($indent, '.1')"/>
                </xsl:apply-templates>                
            </xsl:otherwise>
        </xsl:choose>
        
    </xsl:template>

    <xsl:template match="acSubtermProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> AC Subterm Criterion Processor</h3>
        We use the projection
        <xsl:apply-templates select="multisetArgumentFilter"/>
        to remove the following pairs:
        <xsl:apply-templates select="dps/*"/>
        <xsl:apply-templates select="dpProof">
            <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="switchToTRS">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Switch to TRS Processor</h3>
        We merge the DPs and rules into one TRS.
        <xsl:apply-templates select="trsTerminationProof">
            <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="finitenessAssumption">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Finiteness Assumption</h3>
      We assume finiteness of the DP problem (P,R) where P is
      <xsl:apply-templates select="./dpInput/dps/rules/*/.."/>
      and R is
      <xsl:choose>
        <xsl:when test="count(dpInput/trs/rules/rule) = 0">
          empty.
        </xsl:when>
        <xsl:otherwise>
          the following TRS.
          <xsl:apply-templates select="dpInput/trs/rules/*/.."/>
        </xsl:otherwise>
      </xsl:choose>        
    </xsl:template>

    <xsl:template match="infinitenessAssumption" mode="dpNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Infiniteness Assumption</h3>
        We assume infiniteness of the DP problem (P,R) where P is
        <xsl:apply-templates select="./dpInput/dps/rules/*/.."/>
        and R is
        <xsl:choose>
            <xsl:when test="count(dpInput/trs/rules/rule) = 0">
                empty.
            </xsl:when>
            <xsl:otherwise>
                the following TRS.
                <xsl:apply-templates select="dpInput/trs/rules/*/.."/>
            </xsl:otherwise>
        </xsl:choose>
        <xsl:apply-templates select="dpInput/strategy"/>
    </xsl:template>
    
    <xsl:template match="unknownProof">
        <xsl:param name="indent"/>
        <xsl:call-template name="unknownProof">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template match="unknownProof" mode="complexity">
        <xsl:param name="indent"/>
        <xsl:call-template name="unknownProof">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>
    

    <xsl:template match="unknownProof" mode="relative">
        <xsl:param name="indent"/>
        <xsl:call-template name="unknownProof">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>

    <xsl:template match="unknownProof" mode="relNonterm">
        <xsl:param name="indent"/>
        <xsl:call-template name="unknownProof">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template match="unknownProof" mode="nonterm">       
        <xsl:param name="indent"/>
        <xsl:call-template name="unknownProof">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template match="unknownProof" mode="dpNonterm">       
        <xsl:param name="indent"/>
        <xsl:call-template name="unknownProof">
            <xsl:with-param name="indent" select="$indent"/>
        </xsl:call-template>
    </xsl:template>    
    
    <xsl:template name="unknownProof">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Unknown Proof</h3>
        Using some unknown proof method called 
        <xsl:apply-templates select="description"/>
        one can switch to the following subproblems:
        <ul>
            <xsl:for-each select="subProof">
                <xsl:variable name="nr" select="position()"/>
                <li>
                    <xsl:apply-templates select="*[1]"/>
                    <xsl:apply-templates select="*[2]">
                        <xsl:with-param name="indent" select="concat($indent, concat('.', $nr))"/>
                    </xsl:apply-templates>
                </li>                    
            </xsl:for-each>
        </ul>
    </xsl:template>
    
    <xsl:template match="complexityAssumption" mode="complexity">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Complexity Assumption</h3>
        <xsl:apply-templates select="complexityInput"/>
    </xsl:template>
    
    <xsl:template match="infinitenessAssumption">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Infiniteness Assumption</h3>
      We assume infiniteness of the DP problem (P,R) where P is
      <xsl:apply-templates select="./dpInput/dps/rules/*/.."/>
      and R is
      <xsl:choose>
        <xsl:when test="count(dpInput/trs/rules/rule) = 0">
          empty.
        </xsl:when>
        <xsl:otherwise>
          the following TRS.
          <xsl:apply-templates select="dpInput/trs/rules/*/.."/>
        </xsl:otherwise>
      </xsl:choose>        
    </xsl:template>

    <xsl:template match="terminationAssumption">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Termination Assumption</h3>
      We assume termination of the following TRS
      <xsl:apply-templates select="trsInput/trs/rules/*/.."/>
        <xsl:if test="trsInput/relativeRules/rules/*/..">
            <xsl:text>relative to the following TRS</xsl:text>
            <xsl:apply-templates select="trsInput/relativeRules/rules/*/.."/>
        </xsl:if>
        <xsl:apply-templates select="trsInput/strategy"/>
    </xsl:template>

    <xsl:template match="relativeTerminationAssumption" mode="relative">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Termination Assumption</h3>
      We assume nontermination of R relative to S where R is
      <xsl:apply-templates select="trsInput/trs/rules/*/.."/>
      and S is
      <xsl:choose>
        <xsl:when test="count(trsInput/relativeRules/rules/rule) = 0">
          empty.
        </xsl:when>
        <xsl:otherwise>
          the following TRS.
          <xsl:apply-templates select="trsInput/relativeRules/rules/*/.."/>
        </xsl:otherwise>
      </xsl:choose>        
    </xsl:template>

    <xsl:template match="nonterminationAssumption" mode="nonterm">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Nontermination Assumption</h3>
      We assume nontermination of the following TRS.
      <xsl:apply-templates select="trsInput/trs/rules/*/.."/>
      <xsl:choose>
        <xsl:when test="count(trsInput/relativeRules/rules/rule) = 0">
        </xsl:when>
        <xsl:otherwise>
        Together with the relative rules
        <xsl:apply-templates select="trsInput/relativeRules/rules/*/.."/>
        </xsl:otherwise>
      </xsl:choose>
        <xsl:apply-templates select="trsInput/strategy"/>
    </xsl:template>

    <xsl:template match="redPairProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Reduction Pair Processor</h3>
	<xsl:call-template name="ProofStep">
	  <xsl:with-param name="indent" select="$indent"/>
	  <xsl:with-param name="justification" select="orderingConstraintProof"/>
	  <xsl:with-param name="pairs" select="dps/rules/*"/>
	  <xsl:with-param name="proof" select="dpProof"/>
	</xsl:call-template>
    </xsl:template>
    
    <xsl:template match="conditionalConstraint">
        <xsl:apply-templates mode="cc"/>
    </xsl:template>
    <xsl:template match="implication" mode="cc">
        <xsl:if test="count(*) != 1">(</xsl:if>
        <xsl:for-each select="*">
            <xsl:if test="position() != 1">
                <xsl:value-of select="$implication"/>
            </xsl:if>            
            <xsl:apply-templates select="."/>
        </xsl:for-each>
        <xsl:if test="count(*) != 1">)</xsl:if>
    </xsl:template>
    <xsl:template match="all" mode="cc">
        <xsl:value-of select="$forall"/>
        <xsl:apply-templates select="*[1]"/>
        .        
        <xsl:apply-templates select="*[2]"/>
    </xsl:template>
    <xsl:template match="constraint" mode="cc">
        <xsl:apply-templates select="*[1]"/>
        <xsl:choose>
            <xsl:when test="nonStrict"> <xsl:value-of select="$ge"/> </xsl:when>
            <xsl:when test="rewrite"> <xsl:value-of select="$arrow"/><sup>*</sup> </xsl:when>
            <xsl:when test="strict"> &gt; </xsl:when>            
        </xsl:choose>
        <xsl:apply-templates select="*[3]"/>
    </xsl:template>
    
    <xsl:template match="conditionalConstraintProof">        
        <xsl:apply-templates mode = "cc"/>
    </xsl:template>
    
    <xsl:template match="final" mode="cc">
        <li><p>This constraint is kept as final constraint.</p></li>
    </xsl:template>
    
    <xsl:template match="sameConstructor" mode="cc">
        <li>
            Applying Rule "Same Constructor" results in<br/>             
            <xsl:apply-templates select="*[2]"/>
        </li>
        <xsl:apply-templates select="conditionalConstraintProof"/>
    </xsl:template>

    <xsl:template match="variableEquation" mode="cc">
        <li>
            Applying Rule "Variable in Equation" allows to substitute
          <xsl:apply-templates select="*[1]"/> by <xsl:apply-templates select="*[2]"/> which results in <br/>           
          <xsl:apply-templates select="*[3]"/>          
        </li>
        <xsl:apply-templates select="conditionalConstraintProof"/>
    </xsl:template>
    
    <xsl:template match="deleteCondition" mode="cc">
        <li>
          Applying Rule "Delete Conditions" results in <br/>          
          <xsl:apply-templates select="*[1]"/>          
        </li>
        <xsl:apply-templates select="conditionalConstraintProof"/>
    </xsl:template>

    <xsl:template match="simplifyCondition" mode="cc">
        <li>
            Applying Rule "Simplify Conditions" results in
            <br/>
            <xsl:apply-templates select="*[3]"/>            
        </li>
        <xsl:apply-templates select="conditionalConstraintProof"/>
    </xsl:template>

    <xsl:template match="funargIntoVar" mode="cc">
        <li>
            Applying Rule "Introduce fresh variable" results in
            <br/>
            <xsl:apply-templates select="*[4]"/>            
        </li>
        <xsl:apply-templates select="conditionalConstraintProof"/>
    </xsl:template>
    
    <xsl:template match="differentConstructor" mode="cc">
        <li>Applying Rule "Different Constructors" allows to drop this constraint.</li>
    </xsl:template>
    
    <xsl:template match="induction" mode="cc">
        <li>
            Applying Rule "Induction" on <xsl:apply-templates select="conditionalConstraint"/> results in the following <xsl:value-of select="count(ruleConstraintProofs/ruleConstraintProof)"/> new constraints.
        <ol>
            <xsl:for-each select="ruleConstraintProofs/ruleConstraintProof">
                <li>
                    <xsl:apply-templates select="conditionalConstraint"/>
                    <ul>
                        <xsl:apply-templates select="conditionalConstraintProof"/>
                    </ul>
                </li>
            </xsl:for-each>
        </ol>
        </li>
    </xsl:template>
    
    <xsl:template match="generalRedPairProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Reduction Pair Processor</h3>        
        We apply the generic reduction pair processor using the  
        <xsl:apply-templates select="orderingConstraintProof"/>        
        <p>The pair(s) </p>
        <xsl:apply-templates select="strict"/>
        <p>are strictly oriented and the pair(s)</p>
        <xsl:apply-templates select="bound"/>
        <p>are bounded w.r.t. the constant <xsl:apply-templates select="condRedPairProof/*[1]"/>.
        </p>
        <p>The following constraints are generated for the pairs.</p>
        <ul>
            <xsl:for-each select="condRedPairProof//final/../../conditionalConstraint[last()]">
                <li><xsl:apply-templates select = "."/></li>
            </xsl:for-each>
        </ul>
        
        <p>
        The details are shown below:</p>
        <ul>
            
           <xsl:for-each select="condRedPairProof/conditions/condition">
             <li>
                 For the chain 
                 <xsl:for-each select="dpSequence/rules/rule">
                     <xsl:if test="position() != 1">, </xsl:if>
                     <xsl:apply-templates select="."/>
                 </xsl:for-each>
                 we build the initial constraint
                 <p>
                 <xsl:apply-templates select="conditionalConstraint"/>
                 </p>
                 <p>which is simplified as follows.</p>
                 <ul>
                 <xsl:apply-templates select="conditionalConstraintProof"/>
                 </ul>
             </li>
           </xsl:for-each>
            
        </ul>        
        <p>
        <xsl:choose>
            <xsl:when test="*[6]">
                We get two subproofs, in the first the strict pairs are deleted, in the second the bounded pairs are deleted.
            </xsl:when>
            <xsl:otherwise>
                We remove those pairs which are strictly decreasing and bounded.
            </xsl:otherwise>
        </xsl:choose>
        </p>
        
            <xsl:apply-templates select="*[5]">
                <xsl:with-param name="indent" select="concat($indent,'.1')"/>
            </xsl:apply-templates>
            <xsl:apply-templates select="*[6]">
                <xsl:with-param name="indent" select="concat($indent,'.2')"/>
            </xsl:apply-templates>
            
        
    </xsl:template>
    

    <xsl:template match="redPairUrProc">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Reduction Pair Processor with Usable Rules</h3>
      <xsl:call-template name="ProofStep">
        <xsl:with-param name="indent" select="$indent"/>
          <xsl:with-param name="justification" select="orderingConstraintProof"/>
        <xsl:with-param name="pairs" select="dps/rules/*"/>
        <xsl:with-param name="urules" select="usableRules/rules/*"/>
        <xsl:with-param name="proof" select="dpProof"/>
      </xsl:call-template>
    </xsl:template>
        
    <xsl:template match="monoRedPairProc">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Monotonic Reduction Pair Processor</h3>
      <xsl:call-template name="ProofStep">
        <xsl:with-param name="indent" select="$indent"/>
          <xsl:with-param name="justification" select="orderingConstraintProof"/>
        <xsl:with-param name="pairs" select="dps/rules/*"/>
	<xsl:with-param name="rules" select="trs/rules/*"/>
        <xsl:with-param name="proof" select="dpProof"/>
      </xsl:call-template>
  </xsl:template>

    <xsl:template match="innermostMonoRedPairProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Innermost Monotonic Reduction Pair Processor</h3>
        <xsl:call-template name="NegatedProofStep">
            <xsl:with-param name="indent" select="$indent"/>
            <xsl:with-param name="justification" select="orderingConstraintProof"/>
            <xsl:with-param name="pairs" select="deleted/dps/rules/*"/>
            <xsl:with-param name="rules" select="deleted/trs/rules/*"/>
            <xsl:with-param name="proof" select="dpProof"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template match="acMonoRedPairProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> AC Monotonic Reduction Pair Processor with Usable Rules</h3>
        <xsl:call-template name="NegatedProofStep">
            <xsl:with-param name="indent" select="$indent"/>
            <xsl:with-param name="justification" select="orderingConstraintProof"/>
            <xsl:with-param name="pairs" select="dps/rules/*"/>
            <xsl:with-param name="urules" select="usableRules/rules/*"/>            
            <xsl:with-param name="rules" select="trs/rules/*"/>
            <xsl:with-param name="proof" select="acDPTerminationProof"/>
        </xsl:call-template>
    </xsl:template>

    <xsl:template match="acRedPairProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> AC Reduction Pair Processor with Usable Rules</h3>
        <xsl:call-template name="NegatedProofStep">
            <xsl:with-param name="indent" select="$indent"/>
            <xsl:with-param name="justification" select="orderingConstraintProof"/>
            <xsl:with-param name="urules" select="usableRules/rules/*"/>
            <xsl:with-param name="pairs" select="dps/rules/*"/>
            <xsl:with-param name="proof" select="acDPTerminationProof"/>
        </xsl:call-template>
    </xsl:template>
    
    
    
    <xsl:template match="monoRedPairUrProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Monotonic Reduction Pair Processor with Usable Rules</h3>
        <xsl:call-template name="ProofStep">
            <xsl:with-param name="indent" select="$indent"/>
            <xsl:with-param name="justification" select="orderingConstraintProof"/>
            <xsl:with-param name="pairs" select="dps/rules/*"/>
            <xsl:with-param name="urules" select="usableRules/rules/*"/>
            <xsl:with-param name="rules" select="trs/rules/*"/>
            <xsl:with-param name="proof" select="dpProof"/>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template match="pIsEmpty">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> P is empty </h3>
        <p>There are no pairs anymore.</p>
    </xsl:template>

    <xsl:template match="dpRuleRemoval" mode="dpNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Pair and Rule Removal</h3>
        Some pairs and rules have been removed and it remains to prove infiniteness for the new DP problem (P,R) where P is
        <xsl:choose>
            <xsl:when test="dps">
                <xsl:apply-templates select="dps/rules/*/.."/>
            </xsl:when>
            <xsl:otherwise> unchanged </xsl:otherwise>
        </xsl:choose>        
        and R is
        <xsl:choose>
            <xsl:when test="trs">
                <xsl:choose>
                    <xsl:when test="count(trs/rules/rule) = 0">
                        empty.
                    </xsl:when>
                    <xsl:otherwise>
                        the following TRS.
                        <xsl:apply-templates select="trs/rules/*/.."/>
                    </xsl:otherwise>                    
                </xsl:choose>                
            </xsl:when>
            <xsl:otherwise>
                unchanged.
            </xsl:otherwise>
        </xsl:choose>        
        <p>
            <xsl:apply-templates select="dpNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="ruleRemoval" mode="nonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Rule Removal</h3>
        Some rules have been removed and it remains to disprove termination of the following TRS.
        <xsl:apply-templates select="trs/rules/*/.."/>
        <p>
            <xsl:apply-templates select="trsNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>

    <xsl:template match="ruleShifting" mode="complexity">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Rule Shifting</h3>
        The rules
        <xsl:apply-templates select="trs"/>
        are strictly oriented by the following 
        <xsl:apply-templates select="orderingConstraintProof"/>
        which has the intended complexity.
        <xsl:if test="usableRules">
            Here, only the following usable rules have been considered:
            <xsl:apply-templates select="usableRules"/>
        </xsl:if>
        <p>
            <xsl:apply-templates select="complexityProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>        
    </xsl:template>
    
    <xsl:template match="switchInnermost">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Switch to Innermost Termination</h3>
        <p>The TRS is overlay and locally confluent:</p>        
        
            <xsl:apply-templates select="wcrProof/*"/>
        
        <p>Hence, it suffices to show innermost termination in the following.</p>        
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        
    </xsl:template>
    
    <xsl:template match="switchInnermostProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Switch to Innermost Termination</h3>
        The TRS does not have overlaps with the pairs and is locally confluent:        
        <p>
            <xsl:apply-templates select="wcrProof/*"/>
        </p>
        Hence, it suffices to show innermost termination in the following.
        <p>
            <xsl:apply-templates select="dpProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    

    <xsl:template match="ruleRemoval">
      <xsl:param name="indent"/>
      <h3><xsl:value-of select="$indent"/> Rule Removal</h3>
      Using the
      <xsl:apply-templates select="orderingConstraintProof"/>                
      <xsl:choose>
        <xsl:when test="count(trs/rules/*) &gt; 0">
          the
          rule<xsl:if test="count(trs/rules/*) &gt; 1">s</xsl:if> 
          <xsl:apply-templates select="trs/rules/*/.."/>
          remain<xsl:if test="count(trs/rules/*) = 1">s</xsl:if>.
        </xsl:when>
        <xsl:otherwise>
          all rules could be removed.
        </xsl:otherwise>
      </xsl:choose>
      <p>
        <xsl:apply-templates select="trsTerminationProof">
          <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>
      </p>
    </xsl:template>

    <xsl:template match="acRuleRemoval">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> AC Rule Removal</h3>
        Using the
        <xsl:apply-templates select="orderingConstraintProof"/>                        
                the
                rule<xsl:if test="count(trs/rules/*) &gt; 1">s</xsl:if> 
                <xsl:apply-templates select="trs/rules/*/.."/>
                can be deleted.
        <p>
            <xsl:apply-templates select="acTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="ruleRemoval" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Rule Removal</h3>
        Using the
        <xsl:apply-templates select="orderingConstraintProof"/>                
        <xsl:choose>
            <xsl:when test="count(trs[1]/rules/*) &gt; 0">
                the
                rule<xsl:if test="count(trs[1]/rules/*) &gt; 1">s</xsl:if> 
                <xsl:apply-templates select="trs[1]/rules/*/.."/>
                remain<xsl:if test="count(trs[1]/rules/*) = 1">s</xsl:if> in R.
            </xsl:when>
            <xsl:otherwise>
                all rules of R could be removed.
            </xsl:otherwise>
        </xsl:choose>
        Moreover,
        <xsl:choose>
            <xsl:when test="count(trs[2]/rules/*) &gt; 0">
                the
                rule<xsl:if test="count(trs[2]/rules/*) &gt; 1">s</xsl:if> 
                <xsl:apply-templates select="trs[2]/rules/*/.."/>
                remain<xsl:if test="count(trs[2]/rules/*) = 1">s</xsl:if> in S.
            </xsl:when>
            <xsl:otherwise>
                all rules of S could be removed.
            </xsl:otherwise>
        </xsl:choose>        
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="trsNonterminationProof" mode="relNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Disproving termination of R</h3>
        It follows a proof that R is nonterminating. Hence, R/S is not relative terminating.
        <xsl:apply-templates select=".">
            <xsl:with-param name="indent" select="concat($indent, '.1')"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="ruleRemoval" mode="relNonterm">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Rule Removal</h3>
        Some rules have been removed and it remains to disprove relative termination of the following TRSs R 
        <xsl:apply-templates select="trs[1]/rules/*/.."/>
        and S 
        <xsl:apply-templates select="trs[2]/rules/*/.."/>
        <p>
            <xsl:apply-templates select="relativeNonterminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    
    <xsl:template match="rIsEmpty">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> R is empty </h3>
        <p>There are no rules in the TRS. Hence, it is terminating.</p>
    </xsl:template>

    <xsl:template match="acRIsEmpty">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> R is empty </h3>
        <p>There are no rules in the TRS. Hence, it is AC-terminating.</p>
    </xsl:template>
    
    <xsl:template match="rIsEmpty" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> R is empty </h3>
        <p>There are no rules in the TRS R. Hence, R/S is relative terminating.</p>
    </xsl:template>

    <xsl:template match="rIsEmpty" mode="complexity">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> R is empty </h3>
        <p>There are no rules in the TRS R. Hence, R/S has complexity O(1).</p>
    </xsl:template>

    <xsl:template match="equalityRemoval" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Equality Removal </h3>
        <p>All equality rules (of the form t<xsl:value-of select="$rewrite"/>t) are removed from the non-strict rules. </p>
        <p>
            <xsl:apply-templates select="relativeTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    <xsl:template match="sIsEmpty" mode="relative">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> S is empty </h3>
        <p>There are no rules in the TRS S. Hence, R/S is relative terminating iff R is terminating.</p>
        <p>
            <xsl:apply-templates select="trsTerminationProof">
                <xsl:with-param name="indent" select="concat($indent, '.1')"/>
            </xsl:apply-templates>
        </p>
    </xsl:template>
    
    
    <xsl:template match="sizeChangeProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Size-Change Termination</h3>
        <p>
        Using size-change termination in combination with
        <xsl:choose>
            <xsl:when test="subtermCriterion">
                the subterm criterion
            </xsl:when>
            <xsl:when test="reductionPair">
                the  
                <xsl:apply-templates select="reductionPair/orderingConstraintProof"/>
                with the following set of usable rules
                <xsl:apply-templates select="reductionPair/usableRules/*"/>
            </xsl:when>
            <xsl:otherwise>
                some unknown technique
            </xsl:otherwise>
        </xsl:choose>
        one obtains the following initial size-change graphs.</p>  
        <ul>
            <xsl:for-each select="sizeChangeGraph">
                <li>
                    <p><xsl:apply-templates select="rule"/>:</p>
                    <xsl:for-each select="edge">
                        <xsl:value-of select="*[1]/text()"/>
                        <xsl:text>&gt;</xsl:text><xsl:if test="strict/text() = 'false'">=</xsl:if>
                        <xsl:value-of select="*[3]/text()"/>                        
                        <xsl:if test="position() != last()">, </xsl:if>
                    </xsl:for-each>
                </li>
            </xsl:for-each>
        </ul>
        
        <p>As there is no critical graph in the transitive closure, there are no infinite chains.
        </p>
    </xsl:template>
    
    <xsl:template match="depGraphProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Dependency Graph Processor</h3>
        <xsl:variable name="all" select="count(component)"/>
        <xsl:variable name="real" select="count(component[realScc/text() = 'true'])"/>
        <p>The dependency pairs are split into <xsl:value-of select="$real"/>
        component<xsl:if test="$real != 1">s</xsl:if>.</p>
        <xsl:choose>
            <xsl:when test="$real &gt; 0">
                <ul>    
                    <xsl:apply-templates select="." mode="depGraphIterate">
                        <xsl:with-param name="count" select="1"/>
                        <xsl:with-param name="indent" select="$indent"/>
                        <xsl:with-param name="index" select="1"/>
                        <xsl:with-param name="n" select="$all"/>
                    </xsl:apply-templates>
                </ul>        
            </xsl:when>
        </xsl:choose>        
    </xsl:template>
    
    <xsl:template match="acDepGraphProc">
        <xsl:param name="indent"/>
        <h3><xsl:value-of select="$indent"/> Dependency Graph Processor</h3>
        <xsl:variable name="all" select="count(component)"/>
        <xsl:variable name="real" select="count(component[realScc/text() = 'true'])"/>
        <p>The dependency pairs are split into <xsl:value-of select="$real"/>
            component<xsl:if test="$real != 1">s</xsl:if>.</p>
        <xsl:choose>
            <xsl:when test="$real &gt; 0">
                <ul>    
                    <xsl:apply-templates select="." mode="depGraphIterate">
                        <xsl:with-param name="count" select="1"/>
                        <xsl:with-param name="indent" select="$indent"/>
                        <xsl:with-param name="index" select="1"/>
                        <xsl:with-param name="n" select="$all"/>
                    </xsl:apply-templates>
                </ul>        
            </xsl:when>
        </xsl:choose>        
    </xsl:template>
    
    <xsl:template mode="depGraphIterate" match="*">
        <xsl:param name="indent"/>
        <xsl:param name="count"/>
        <xsl:param name="index"/>
        <xsl:param name="n"/>
        <xsl:variable name="newindex" select="$index + count(component[$count]/realScc[text() = 'true'])"/>
        <xsl:if test="$index != $newindex">
            <li>
                The
                <xsl:choose>
                    <xsl:when test="$index = 1">1<sup>st</sup></xsl:when>
                    <xsl:when test="$index = 2">2<sup>nd</sup></xsl:when>
                    <xsl:when test="$index = 3">3<sup>rd</sup></xsl:when>
                    <xsl:otherwise><xsl:value-of select="$index"/><sup>th</sup></xsl:otherwise>
                </xsl:choose>
                component contains the
                pair<xsl:if test="count(component[$count]/dps/rules/rule) &gt; 1">s</xsl:if>
                <xsl:apply-templates select="component[$count]/dps/*"/>
                <xsl:variable name="sub_index" select="count(component[$count]/*)"/>
                <xsl:apply-templates select="component[$count]/*[$sub_index]">
                    <xsl:with-param name="indent" select="concat($indent, '.', $index)"/>   
                </xsl:apply-templates>
            </li>
        </xsl:if>
        <xsl:if test="$count &lt; $n">
            <xsl:apply-templates select="." mode="depGraphIterate">
                <xsl:with-param name="indent" select="$indent"/>
                <xsl:with-param name="count" select="$count + 1"/>
                <xsl:with-param name="index" select="$newindex"/>
                <xsl:with-param name="n" select="$n"/>
            </xsl:apply-templates>
        </xsl:if>        
    </xsl:template>
    
    <!-- variables always in red -->
    <xsl:template name="var" match="var">
        <span class="var"><xsl:value-of select="."/></span>
    </xsl:template>
    

    <xsl:template match="labeling">
        <span class="label">
            <xsl:if test="count(number) != 1"><xsl:text>(</xsl:text></xsl:if>
            <xsl:for-each select="number">
                <xsl:apply-templates/>
                <xsl:if test="position() != last()">,</xsl:if>                    
            </xsl:for-each>
            <xsl:if test="count(number) != 1"><xsl:text>)</xsl:text></xsl:if>
            <xsl:if test="position() != last()">,</xsl:if>
        </span>
    </xsl:template>

    <xsl:template match="sharp">
        <span class="dp_fun">
            <xsl:apply-templates select="*[1]">
                <xsl:with-param name="sharp">true</xsl:with-param>
            </xsl:apply-templates>
            <sup>#</sup>
        </span>        
    </xsl:template>

    <xsl:template match="name">
        <xsl:param name="sharp">false</xsl:param>
        <xsl:choose>
            <xsl:when test="$sharp = 'true'">
                <xsl:value-of select="text()"/>                
            </xsl:when>
            <xsl:otherwise>
                <span class="fun">
                    <xsl:value-of select="text()"/>
                </span>
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>

    <xsl:template match="numberLabel">
        <span class="label">
            <xsl:apply-templates/>
        </span>
    </xsl:template>
    <xsl:template match="symbolLabel">
        <span class="label">
            <xsl:apply-templates/>
        </span>
    </xsl:template>
    
    <xsl:template match="labeledSymbol">
        <xsl:param name="sharp">false</xsl:param>
        <xsl:apply-templates select="*[1]">
            <xsl:with-param name="sharp" select="$sharp"/>
        </xsl:apply-templates>
        <sub>
            <xsl:apply-templates select="*[2]"/>
        </sub>
    </xsl:template>
    
    <xsl:template match="funapp">
      <xsl:apply-templates select="*[1]"/>
      <xsl:if test="count(arg) &gt; 0">
      <xsl:text>(</xsl:text>
      <xsl:for-each select="arg">
        <xsl:apply-templates/>
        <xsl:if test="position() != last()">,</xsl:if>
      </xsl:for-each>
      <xsl:text>)</xsl:text>
      </xsl:if>
    </xsl:template>
    
    <xsl:template match="box">
        <span style="color:purple"><xsl:value-of select="$box"/></span>
    </xsl:template>
    
    <xsl:template match="funContext">
        <xsl:apply-templates select="*[1]"/>
        <xsl:text>(</xsl:text>
        <xsl:for-each select="before/*">
            <xsl:apply-templates select="."/><xsl:text>,</xsl:text>
        </xsl:for-each>
        <xsl:apply-templates select="*[3]"/>
        <xsl:for-each select="after/*">
            <xsl:text>,</xsl:text><xsl:apply-templates select="."/>
        </xsl:for-each>
        <xsl:text>)</xsl:text>
    </xsl:template>
    
    <xsl:template match="rule">
        <table style="margin-left:20px">
            <xsl:call-template name="rule">
              <xsl:with-param name="arr" select="$arrow"/>
            </xsl:call-template>
       </table>
    </xsl:template>

    <xsl:template name="rule">
      <xsl:param name="arr"/>
      <tr>
        <td align="right">
          <xsl:apply-templates select="lhs"/>
        </td>
        <td>
          <xsl:value-of select="$arr"/>
        </td>
        <td>
          <xsl:apply-templates select="rhs"/>
        </td>
        <xsl:for-each select="conditions">
          <td>
            <xsl:text> | </xsl:text>
            <xsl:call-template name="conditions"/>
          </td>
        </xsl:for-each>
      </tr>
    </xsl:template>

    <xsl:template match="equations">
        <xsl:for-each select="rules">
            <xsl:call-template name="rules">
                <xsl:with-param name="arr">=</xsl:with-param>
                <xsl:with-param name="name">equations</xsl:with-param>
            </xsl:call-template>
        </xsl:for-each>
    </xsl:template>    
        
    <xsl:template match="rules">
        <xsl:call-template name="rules">
            <xsl:with-param name="arr"><xsl:value-of select="$arrow"/></xsl:with-param>
            <xsl:with-param name="name">rules</xsl:with-param>
        </xsl:call-template>
    </xsl:template>
    
    <xsl:template name="rules">
        <xsl:param name="arr"/>
        <xsl:param name="name"/>
            <xsl:choose>
                <xsl:when test="count(rule) = 0">
                    <p>
                    <xsl:text>There are no </xsl:text>
                    <xsl:value-of select="$name"/>
                    <xsl:text>.</xsl:text>
                    </p>
                </xsl:when>
                <xsl:otherwise>
                    <table style="margin-left:20px">
                        <xsl:for-each select="rule">
                          <xsl:call-template name="rule">
                            <xsl:with-param name="arr" select="$arr"/>
                            <xsl:with-param name="name" select="$name"/>
                          </xsl:call-template>
                        </xsl:for-each>
                    </table>
                </xsl:otherwise>
            </xsl:choose>        
    </xsl:template>
    
    <xsl:template match="substitution">
        <xsl:choose>
            <xsl:when test="count(substEntry) = 0">
                <xsl:value-of select="$emptyset"/>
            </xsl:when>
            <xsl:otherwise>    
                {<xsl:for-each select="substEntry">
                    <xsl:apply-templates select="*[1]"/>/<xsl:apply-templates select="*[2]"/>
                    <xsl:if test="last() != position()">, </xsl:if>
                </xsl:for-each>}
            </xsl:otherwise>
        </xsl:choose>
    </xsl:template>
    
    
</xsl:stylesheet>
