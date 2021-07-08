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
  Card
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
import { login } from "../../actions/users/";

const Login = ({ navigation }) => {
  const [secureTextEntry, setSecureTextEntry] = useState(true),
    [responseMessage, setResponseMessage] = useState(null),
    [isSubmitting, setIsSubmitting] = useState(false),
    toggleSecureEntry = () => {
      setSecureTextEntry(!secureTextEntry);
    },
    renderIcon = (props) => (
      <TouchableWithoutFeedback onPress={toggleSecureEntry}>
        <Icon {...props} name={secureTextEntry ? "eye-off" : "eye"} />
      </TouchableWithoutFeedback>
    ),
    formSchema = yup.object({
      matricNo: yup
        .string("Matric Number must be valid.")
        .required("Matric Number is required."),
      password: yup
        .string()
        .min(3, "Password must more than 3 characters.")
        .required("Password is required.")
    }),
    dispatch = useDispatch(),
    successCallback = () => {
      navigation.navigate("HomeScreen");
    },
    errorCallback = (error) => {
      console.log(error);
      setIsSubmitting(false);
      setResponseMessage(error);
    },
    callback = {
      success: successCallback,
      error: errorCallback
    },
    onSubmit = (data) => {
      setIsSubmitting(true);
      setResponseMessage(null);
        dispatch(login(data, callback));
    },
    LoadingIndicator = (props) => (
      <View style={[props.style, styles.indicator]}>
        {isSubmitting === true ? <Spinner status="control" size="small" /> : null}
      </View>
    );

  return (
    <SafeAreaView style={[globalStyles.root, globalStyles.screenBg]}>
      <Layout>
        <View style={[globalStyles.containerPadding]}>
          <View style={[styles.heading]}>
            <Text
              style={[
                globalStyles.textPrimary,
                globalStyles.fontAltBold,
                { fontSize: 30 }
              ]}
            >
              Login
            </Text>
            <Text style={[globalStyles.textPrimary, globalStyles.fontRegular]}>
              Welcome back!
            </Text>
          </View>

          <Card>
            <Formik
              validationSchema={formSchema}
              initialValues={{
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
                      <Text style={globalStyles.textWhite}>Login</Text>
                    </Button>
                    {responseMessage ? <Text style={globalStyles.textDanger}>{responseMessage}</Text> : null
                    
                    }                    
                  </View>
                  <View style={[globalStyles.formGroup]}>
                    <Button
                      size="tiny"
                      style={[
                        globalStyles.borderPrimary,
                        globalStyles.bgTransparent,
                        styles.round
                      ]}
                      onPress={() => navigation.navigate("RegisterScreen")}
                    >
                      <Text style={globalStyles.textPrimary}>
                        Don't have an account? sign up now
                      </Text>
                    </Button>
                  </View>
                </>
              )}
            </Formik>
          </Card>
        </View>
      </Layout>
    </SafeAreaView>
  );
};
export default Login;

const styles = StyleSheet.create({
  heading: {
    marginVertical: (globalConstants.SCREEN_HEIGHT * 10) / 100
  },
  round: {
    borderRadius: 50
  }
});
