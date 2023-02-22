import { createHelpers } from 'vuex-map-fields';
const { getScheduleField, updateScheduleField } = createHelpers({
  getterType: 'getScheduleField',
  mutationType: 'updateScheduleField',
});
const state = {
  showDialogCreateUpdate: false,
  showDialogCreateFromApi: false,
};

const mutations = {
  updateScheduleField,
};

const actions = {

};

const getters = {
  getScheduleField,
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
  getters,
};
