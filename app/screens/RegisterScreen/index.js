import React, { useState } from "react";
import {
  Button,
  Input,
  Layout,
  Text,
  Icon,
  Popover,
  Spinner,
  ButtonGroup,
  Card,
  IndexPath,
  Select,
  SelectGroup,
  SelectItem
} from "@ui-kitten/components";
import { globalStyles } from "../../shared/globalStyles";
import { Formik } from "formik";
import * as yup from "yup";
import {
  View,
  StyleSheet,
  TouchableWithoutFeedback,
  SafeAreaView
} from "react-native";
import { useDispatch, useSelector } from "react-redux";
import { globalConstants } from "../../constants";
import { ScrollView } from "react-native-gesture-handler";
// import { login } from "../../actions/";

const levels = ["Select Level", "ND I", "ND II", "HND I", "HND II"];

const Register = ({ navigation }) => {
  const [secureTextEntry, setSecureTextEntry] = useState(true),
    [responseMessage, setResponseMessage] = useState(null),
    [isSubmitting, setIsSubmitting] = useState(false),
    [popOver, setPopOver] = useState(false),
    [selectedLevel, setSelectedLevel] = React.useState(new IndexPath(0)),
    displayValue = levels[selectedLevel.row],
    toggleSecureEntry = () => {
      setSecureTextEntry(!secureTextEntry);
    },
    renderIcon = (props) => (
      <TouchableWithoutFeedback onPress={toggleSecureEntry}>
        <Icon {...props} name={secureTextEntry ? "eye-off" : "eye"} />
      </TouchableWithoutFeedback>
    ),
    renderLevelOptions = (title) => (
      <SelectItem
        disabled={title == "Select Level" ? true : false}
        title={title}
      />
    ),
    formSchema = yup.object({
      phone: yup
        .string("Phone Numver must be valid.")
        .required("Phone Numver is required."),
      matricNo: yup
        .string("Matric Number must be valid.")
        .required("Matric Number is required."),
      fullname: yup
        .string("Fullname must be valid.")
        .required("Fullname is required."),
      password: yup
        .string()
        .min(3, "Password must more than 3 characters.")
        .required("Password is required.")
    }),
    dispatch = useDispatch(),
    successCallback = () => {
      navigation.navigate("Home");
    },
    errorCallback = (error) => {
      setIsSubmitting(false);
      setPopOver(true);
      setResponseMessage(error);
    },
    callback = {
      success: successCallback,
      error: errorCallback
    },
    onSubmit = (data) => {
      // Alert.alert("3");
      console.log(data);
      setIsSubmitting(true);
      setResponseMessage(null);
      console.log(data);
      //   dispatch(login(data, callback));
    },
    LoadingIndicator = (props) => (
      <View style={[props.style, styles.indicator]}>
        {isSubmitting === true ? <Spinner size="small" /> : null}
      </View>
    );

  const renderToggleButton = () => <></>;

  return (
    <SafeAreaView style={[globalStyles.root, globalStyles.screenBg]}>
      <Layout>
        <ScrollView>
          <View style={[globalStyles.containerPadding]}>
            <View style={[styles.heading]}>
              <Text
                style={[
                  globalStyles.textPrimary,
                  globalStyles.fontAltBold,
                  { fontSize: 30 }
                ]}
              >
                Sign Up
              </Text>
              <Text
                style={[globalStyles.textPrimary, globalStyles.fontRegular]}
              >
                Glad to have you here!
              </Text>
            </View>

            <Card>
              <Formik
                validationSchema={formSchema}
                initialValues={{
                  fullname: "",
                  phone: "",
                  matricNo: "",
                  password: ""
                }}
                onSubmit={(details) => {
                  onSubmit(details);
                }}
              >
                {(props) => (
                  <>
                    <View style={[globalStyles.formGroup]}>
                      <Input
                        label="Fullname"
                        onChangeText={props.handleChange("fullname")}
                        value={props.values.fullname}
                        textStyle={globalStyles.textPrimary}
                        status={
                          props.values.fullname == "" && props.errors.fullname
                            ? "danger"
                            : "warning"
                        }
                      />
                    </View>
                    
                    <View style={[globalStyles.formGroup]}>
                      <Input
                        label="Matric No"
                        onChangeText={props.handleChange("matricNo")}
                        value={props.values.matricNo}
                        textStyle={globalStyles.textPrimary}
                        status={
                          props.values.matricNo == "" && props.errors.matricNo
                            ? "danger"
                            : "warning"
                        }
                      />
                    </View>
                    
                    <View style={[globalStyles.formGroup]}>
                      <Input
                        label="Phone Number"
                        keyboardType="phone-pad"
                        onChangeText={props.handleChange("phone")}
                        value={props.values.phone}
                        textStyle={globalStyles.textPrimary}
                        status={
                          props.values.phone == "" && props.errors.phone
                            ? "danger"
                            : "warning"
                        }
                      />
                    </View>
                    

                    <View style={[globalStyles.formGroup]}>
                      <Input
                        label="Password"
                        placeholder="***"
                        accessoryRight={renderIcon}
                        secureTextEntry={secureTextEntry}
                        onChangeText={props.handleChange("password")}
                        value={props.values.password}
                        status={
                          props.values.password == "" && props.errors.password
                            ? "danger"
                            : "warning"
                        }
                        textStyle={globalStyles.textPrimary}
                      />
                    </View>
                    <View style={[globalStyles.formGroup]}>
                      <Button
                        disabled={isSubmitting ? true : false}
                        onPress={props.handleSubmit}
                        style={[
                          globalStyles.btn,
                          globalStyles.bgSecondary,
                          globalStyles.noBorder
                        ]}
                        accessoryLeft={
                          isSubmitting === true ? LoadingIndicator : null
                        }
                      >
                        <Text style={globalStyles.textWhite}>Register</Text>
                      </Button>
                      <Popover
                        visible={popOver}
                        fullWidth={true}
                        anchor={renderToggleButton}
                        onBackdropPress={() => setVisible(false)}
                      >
                        <Layout
                          style={[globalStyles.bgDanger, { padding: 10 }]}
                        >
                          <Text style={[globalStyles.textPrimary]}>
                            {responseMessage}
                          </Text>
                        </Layout>
                      </Popover>
                    </View>
                    <View style={[globalStyles.formGroup]}>
                      <Button
                        size="tiny"
                        style={[
                          globalStyles.borderPrimary,
                          globalStyles.bgTransparent,
                          styles.round
                        ]}
                        onPress={() => navigation.navigate("LoginScreen")}
                      >
                        <Text style={globalStyles.textPrimary}>
                          Already a member? login now
                        </Text>
                      </Button>
                    </View>
                  </>
                )}
              </Formik>
            </Card>
          </View>
        </ScrollView>
      </Layout>
    </SafeAreaView>
  );
};
export default Register;

const styles = StyleSheet.create({
  heading: {
    marginVertical: (globalConstants.SCREEN_HEIGHT * 4) / 100
  },
  round: {
    borderRadius: 50
  }
});
