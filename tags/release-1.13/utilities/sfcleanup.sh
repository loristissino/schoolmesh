#!/bin/bash
#This script just removes some unused symfony directory and files.

pwd | grep "lib/vendor/symfony$" > /dev/null

if [[ $? -ne 0 ]]; then
  echo not in the lib/vendor/symfony directory
  exit 1
fi

rm -rfv test

rm -rfv lib/plugins/sfDoctrinePlugin

cd lib/i18n/data
rm -v af.dat \
af_NA.dat \
af_ZA.dat \
am.dat \
am_ET.dat \
ar_AE.dat \
ar_BH.dat \
ar.dat \
ar_DZ.dat \
ar_EG.dat \
ar_IQ.dat \
ar_JO.dat \
ar_KW.dat \
ar_LB.dat \
ar_LY.dat \
ar_MA.dat \
ar_OM.dat \
ar_QA.dat \
ar_SA.dat \
ar_SD.dat \
ar_SY.dat \
ar_TN.dat \
ar_YE.dat \
as.dat \
as_IN.dat \
az_AZ.dat \
az_Cyrl_AZ.dat \
az_Cyrl.dat \
az.dat \
az_Latn_AZ.dat \
az_Latn.dat \
be_BY.dat \
be.dat \
bg_BG.dat \
bg.dat \
bn_BD.dat \
bn.dat \
bn_IN.dat \
bo_CN.dat \
bo.dat \
bo_IN.dat \
ca.dat \
ca_ES.dat \
cs_CZ.dat \
cs.dat \
cy.dat \
cy_GB.dat \
da.dat \
da_DK.dat \
de_AT.dat \
de_BE.dat \
de_CH.dat \
de.dat \
de_DE.dat \
de_LI.dat \
de_LU.dat \
el_CY.dat \
el.dat \
el_GR.dat \
eo.dat \
et.dat \
et_EE.dat \
eu.dat \
eu_ES.dat \
fa_AF.dat \
fa.dat \
fa_IR.dat \
fi.dat \
fi_FI.dat \
fo.dat \
fo_FO.dat \
ga.dat \
ga_IE.dat \
gl.dat \
gl_ES.dat \
gsw_CH.dat \
gsw.dat \
gu.dat \
gu_IN.dat \
gv.dat \
gv_GB.dat \
ha.dat \
ha_GH.dat \
ha_Latn.dat \
ha_Latn_GH.dat \
ha_Latn_NE.dat \
ha_Latn_NG.dat \
ha_NE.dat \
ha_NG.dat \
haw.dat \
haw_US.dat \
he2.dat \
he.dat \
he_IL.dat \
hi.dat \
hi_IN.dat \
hr.dat \
hr_HR.dat \
hu.dat \
hu_HU.dat \
hy_AM.dat \
hy_AM_REVISED.dat \
hy.dat \
id.dat \
id_ID.dat \
ii_CN.dat \
ii.dat \
in.dat \
in_ID.dat \
is.dat \
is_IS.dat \
iw.dat \
iw_IL.dat \
ja.dat \
ja_JP.dat \
ja_JP_TRADITIONAL.dat \
ka.dat \
ka_GE.dat \
kk_Cyrl.dat \
kk_Cyrl_KZ.dat \
kk.dat \
kk_KZ.dat \
kl.dat \
kl_GL.dat \
km.dat \
km_KH.dat \
kn.dat \
kn_IN.dat \
ko.dat \
kok.dat \
kok_IN.dat \
ko_KR.dat \
kw.dat \
kw_GB.dat \
lt.dat \
lt_LT.dat \
lv.dat \
lv_LV.dat \
mk.dat \
mk_MK.dat \
ml.dat \
ml_IN.dat \
mr.dat \
mr_IN.dat \
ms_BN.dat \
ms.dat \
ms_MY.dat \
mt.dat \
mt_MT.dat \
nb.dat \
nb_NO.dat \
ne.dat \
ne_IN.dat \
ne_NP.dat \
nl_BE.dat \
nl.dat \
nl_NL.dat \
nn.dat \
nn_NO.dat \
no.dat \
no_NO.dat \
no_NO_NY.dat \
om.dat \
om_ET.dat \
om_KE.dat \
or.dat \
or_IN.dat \
pa_Arab.dat \
pa_Arab_PK.dat \
pa.dat \
pa_Guru.dat \
pa_Guru_IN.dat \
pa_IN.dat \
pa_PK.dat \
ps_AF.dat \
ps.dat \
pt_BR.dat \
pt.dat \
pt_PT.dat \
ro.dat \
ro_MD.dat \
ro_RO.dat \
ru.dat \
ru_RU.dat \
ru_UA.dat \
sh_BA.dat \
sh_CS.dat \
sh.dat \
sh_YU.dat \
si.dat \
si_LK.dat \
sk.dat \
sk_SK.dat \
sl.dat \
sl_SI.dat \
so.dat \
so_DJ.dat \
so_ET.dat \
so_KE.dat \
so_SO.dat \
sq_AL.dat \
sq.dat \
sr_BA.dat \
sr_CS.dat \
sr_Cyrl_BA.dat \
sr_Cyrl_CS.dat \
sr_Cyrl.dat \
sr_Cyrl_ME.dat \
sr_Cyrl_RS.dat \
sr_Cyrl_YU.dat \
sr.dat \
sr_Latn_BA.dat \
sr_Latn_CS.dat \
sr_Latn.dat \
sr_Latn_ME.dat \
sr_Latn_RS.dat \
sr_Latn_YU.dat \
sr_ME.dat \
sr_RS.dat \
sr_YU.dat \
sv.dat \
sv_FI.dat \
sv_SE.dat \
sw.dat \
sw_KE.dat \
sw_TZ.dat \
ta.dat \
ta_IN.dat \
te.dat \
te_IN.dat \
th.dat \
th_TH.dat \
th_TH_TRADITIONAL.dat \
ti.dat \
ti_ER.dat \
ti_ET.dat \
tr.dat \
tr_TR.dat \
uk.dat \
uk_UA.dat \
ur.dat \
ur_IN.dat \
ur_PK.dat \
uz_AF.dat \
uz_Arab_AF.dat \
uz_Arab.dat \
uz_Cyrl.dat \
uz_Cyrl_UZ.dat \
uz.dat \
uz_Latn.dat \
uz_Latn_UZ.dat \
uz_UZ.dat \
vi.dat \
vi_VN.dat \
zh_CN.dat \
zh.dat \
zh_Hans_CN.dat \
zh_Hans.dat \
zh_Hans_HK.dat \
zh_Hans_MO.dat \
zh_Hans_SG.dat \
zh_Hant.dat \
zh_Hant_HK.dat \
zh_Hant_MO.dat \
zh_Hant_TW.dat \
zh_HK.dat \
zh_MO.dat \
zh_SG.dat \
zh_TW.dat \
zu.dat \
zu_ZA.dat 
